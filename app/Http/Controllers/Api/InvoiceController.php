<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\Kuitansi;
use App\Services\AturTokoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Cache;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    public $atService;
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(AturTokoService $atService)
    {
        $this->atService = $atService;
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function index()
    {
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();
        return response()->json($this->atService->login($input), 200);
    }

    public function getToken()
    {
        $input = [
            'username' => 'putri',
            'password' => '112233',
        ];
        $inputReq['authorization_code'] = $this->atService->login($input)['data']['data']['authorization_code'];
        $token = $this->atService->getToken($inputReq)['data']['data']['access_token'];
        $expiresAt = $this->atService->getToken($inputReq)['data']['data']['expires_at'];
        // Cache::put('X-Access-Token', $token, $expiresAt);

        $req = [
            "marketplace" => [],
            "status" => [
                "UNP",
                "RTS",
                "PRC",
                "CAN",
                "SHP",
                "DLV",
                "INV",
                "UNK",
                "EXP",
                "REM",
                "COM",
            ],
            "from" => 1625072400000,
            "to" => 1627664400000,
            "orderby" => "order_id",
            "order" => "asc",
            "page" => 0,
            "size" => 10,
            "query" => "",
        ];
        $header = [
            "X-Access-Token" => $token,
            'Content-Type' => 'application/json',
        ];
        $orderList = $this->atService->getListOrder($req, $header)['data']['data'];
        $invoices = [];
        foreach ($orderList as $orderData) {
            $reqDetail = [
                "order_id" => $orderData["channel_order_id"],
            ];
            $invoices[] = $this->atService->getOrderDetail($reqDetail, $header)['data']['data'];
        }

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['datas' => $invoices])->setPaper('a4', 'portrait');
        return $pdf->stream();
        // return response()->json($generates, 200);
    }

    // public function excel()
    // {
    //     $data = Excel::toArray(new Kuitansi(), $request->file);
    //     echo json_encode($data);
    //     // $data = Excel::toArray(new Kuitansi(), $request->file);
    //     // $phoneNumbersData = [];
    //     // foreach ($data[0] as $key => $value) {
    //     //     $phoneNumbersData[] = $value[0];
    //     // }
    //     // return $phoneNumbersData;
    // }

    public function pembulatan($uang)
    {
        $ratusan = substr($uang, -3);
        if ($ratusan < 500) {
            $akhir = $uang - $ratusan;
        } else {
            $akhir = $uang + (1000 - $ratusan);
        }

        //  echo number_format($akhir, 2, ',', '.');;
        return $akhir;
    }

    public function importTest()
    {
        // $rows = [];
        $rows = Excel::toArray(new Kuitansi, public_path("app/penjualanjan2020.xls"));

        // $rows = Excel::toArray(new Kuitansi, $request->file('sampledata'));
        $datas = [];
        $i = 0;
        foreach ($rows[0] as $row) {
            $i++;
            if ($i <= 6) {
                continue;
            }
            // if ($i == 32) {
            //     break;
            // }
            $isExit = false;
            foreach ($datas as &$data) {
                if ($data["channel_order_id"] == "${row[1]}") {
                    $isExit = true;
                    $discExl = (int) $row[11] - (int) $row[13];
                    $discIcld = 0;
                    if ($discExl != 0) {
                        $discIcld = $discExl + ($discExl * 0.1);
                    }
                    $item = [
                        "name" => $row[7],
                        "quantity" => $row[4],
                        "price" => $row[9],
                        "discount" => $this->pembulatan((int)$discIcld),
                        "ppn" => $row[17],
                    ];
                    $data["items"][] = $item;
                    $data["total"] += $row[6];
                }
            }
            if (!$isExit) {
                $discExl = (int) $row[11] - (int) $row[13];
                $discIcld = 0;
                if ($discExl != 0) {
                    $discIcld = $discExl + ($discExl * 0.1);
                }
                $item = [
                    "name" => $row[7],
                    "quantity" => $row[4],
                    "price" => $row[9],
                    "discount" => $this->pembulatan((int)$discIcld),
                    "ppn" => $row[17],
                ];
                $data = [
                    "channel_order_id" => "${row[1]}",
                    "channel_name" => $row[8],
                    "order_date" => $row[2],
                    "items" => [
                        $item,
                    ],
                    "total" => $row[6],
                ];
                $datas[] = $data;
            }
        }
        $result = [];
        for ($i = 0;$i < 24;$i++) {
            $result[] = $datas[$i];
        }
        // return response()->json($result, 200);
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['datas' => $result])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function dump()
    {
        $invoices = [
            [
                "order_id" => "2771200",
                "channel_name" => "shopee",
                "channel_order_id" => "2771200",
                "channel_invoice" => "2771200",
                "customer_name" => "diana gloria",
                "customer_email" => null,
                "customer_address" => "Jln babarsari ,(kompleks yadara blok 4) kos wisma oren no 13A, KAB. SLEMAN, DEPOK, DI YOGYAKARTA, ID, 55282",
                "order_date" => 1579021200000,
                "order_status" => "READY TO SHIP",
                "order_status_code" => null,
                "payment_method" => "SPayLater",
                "shipping" => [
                    "shipping_carrier" => "",
                    "shipping_cost" => 22000,
                    "shipping_awb" => "",
                    "shipping_type" => null,
                ],
                "items" => [
                    [
                        "item_id" => "9302529866",
                        "item_weight" => "0.03",
                        "sku" => "ESQA0099",
                        "name" => "The Goddess Cheek Palette Aphrodite",
                        "quantity" => 1,
                        "price" => 295000,
                        "discount" => 134090,
                        "product_type" => null,
                        "ppn" => 16091,
                    ],
                ],
                "total" => 160909,
                "total_record_items" => 1,
                "package_blibli" => null,
            ],
            [
                "order_id" => "2861700",
                "channel_name" => "shopee",
                "channel_order_id" => "2861700",
                "channel_invoice" => "2861700",
                "customer_name" => "Dina Amalia @dinaamel29",
                "customer_email" => null,
                "customer_address" => "Jln babarsari ,(kompleks yadara blok 4) kos wisma oren no 13A, KAB. SLEMAN, DEPOK, DI YOGYAKARTA, ID, 55282",
                "order_date" => 1578330000000,
                "order_status" => "READY TO SHIP",
                "order_status_code" => null,
                "payment_method" => "SPayLater",
                "shipping" => [
                    "shipping_carrier" => "",
                    "shipping_cost" => 22000,
                    "shipping_awb" => "",
                    "shipping_type" => null,
                ],
                "items" => [
                    [
                        "item_id" => "9302529866",
                        "item_weight" => "0.03",
                        "sku" => "ESQA0099",
                        "name" => "ESQA Goddess Eyeshadow Palette - Pink",
                        "quantity" => 1,
                        "price" => 245000,
                        "discount" => 22273,
                        "product_type" => null,
                        "ppn" => 2273,
                    ],
                    [
                        "item_id" => "9302529866",
                        "item_weight" => "0.03",
                        "sku" => "ESQA0099",
                        "name" => "The Goddess Cheek Palette Athena",
                        "quantity" => 1,
                        "price" => 295000,
                        "discount" => 26818,
                        "product_type" => null,
                        "ppn" => 26812,
                    ],
                ],
                "total" => 490909,
                "total_record_items" => 2,
                "package_blibli" => null,
            ],
        ];
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['datas' => $invoices])->setPaper('a4', 'portrait');
        return $pdf->stream();
        // return response()->json($generates, 200);
    }
}
