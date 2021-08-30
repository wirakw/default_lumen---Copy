<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\Kuitansi;
use App\Services\AturTokoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class KuitansiController extends Controller
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

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx',
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('app', $nama_file);
        $rows = Excel::toArray(new Kuitansi, public_path("app/" . $nama_file));
        Log::info($rows);
        try {
            if (count($rows) > 0) {
                // DB::beginTransaction();
                $datas = [];
                foreach ($rows[0] as $row) {
                    if ($row[4] == "Quantity") {
                        continue;
                    }
                    if (isset($row[7]) && isset($row[4]) && isset($row[9]) && isset($row[16]) && isset($row[18]) && isset($row[8]) && isset($row[6])) {
                        $isExit = false;
                        for ($iter = 0; $iter < count($datas); $iter++) {
                            if ($datas[$iter]["channel_order_id"] == "${row[1]}") {
                                $isExit = true;
                                $item = [
                                    "name" => $row[7],
                                    "quantity" => $row[4],
                                    "price" => $row[9],
                                    "discount" => round($row[16]),
                                    "ppn" => $row[18],
                                ];
                                $datas[$iter]["items"][] = $item;
                                $datas[$iter]["total"] += $row[6];
                            }
                        }
                        if (!$isExit) {
                            $item = [
                                "name" => $row[7],
                                "quantity" => $row[4],
                                "price" => $row[9],
                                "discount" => round($row[16]),
                                "ppn" => $row[18],
                            ];
                            if (isset($row[2])) {
                                $date = strtodate($row[2]);
                            }
                            if ($row[8] == "WHATSAPP ORDER") {
                                $row[8] = "WO";
                            }
                            if ($row[8] == "ESQA WEBSITE") {
                                $row[8] = "WEBSITE";
                            }
                            $data = [
                                "channel_order_id" => "${row[1]}",
                                "channel_name" => $row[8],
                                "order_date" => $date,
                                "items" => [
                                    $item,
                                ],
                                "total" => $row[6],
                            ];
                            $datas[] = $data;
                        }
                    }
                }
                // $result = [];
                // for ($i = 0; $i < count($datas); $i++) {
                //     $result[] = $datas[$i];
                // $dataInsert = $datas[$i];
                // unset($dataInsert['items']);
                // $transaction = Transaction::firstOrCreate($dataInsert);
                // foreach ($datas[$i]['items'] as &$item) {
                // $item['transaction_id'] = $transaction->id;
                // TransactionDetail::firstOrCreate($item);
                // }
                // }
                // dd($result);
                // DB::commit();
            }

            return view('pdf.invoice', ['datas' => $datas]);
            //  return response()->json([
            //     'success' => true,
            //     'date' => $result
            // ], 200);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'please recheck the template',
            ], 422);
        }
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
            "marketplace" => ["TPD"],
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
            "from" => 1627750800000,
            "to" => 1630256400000,
            "orderby" => "order_id",
            "order" => "asc",
            "page" => 0,
            "size" => 299,
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

        // return response()->json($invoices, 200);
        return view('pdf.kuitansi', ['datas' => $invoices]);
        // $pdf = app()->make('dompdf.wrapper');
        // $pdf->loadView('pdf.invoice', ['datas' => $invoices])->setPaper('a4', 'portrait');
        // return $pdf->stream();
        // return response()->json($generates, 200);
    }

    public function importTest()
    {
        $rows = Excel::toArray(new Kuitansi, public_path("app/janwa2020.xls"));
        $datas = [];
        foreach ($rows[0] as $row) {
            if ($row[4] == "Quantity") {
                continue;
            }
            if (isset($row[7]) && isset($row[4]) && isset($row[9]) && isset($row[16]) && isset($row[18]) && isset($row[8]) && isset($row[6])) {
                $isExit = false;
                for ($iter = 0; $iter < count($datas); $iter++) {
                    if ($datas[$iter]["channel_order_id"] == "${row[1]}") {
                        $isExit = true;
                        $item = [
                            "name" => $row[7],
                            "quantity" => $row[4],
                            "price" => $row[9],
                            "discount" => round($row[16]),
                            "ppn" => $row[18],
                        ];
                        $datas[$iter]["items"][] = $item;
                        $datas[$iter]["total"] += $row[6];
                    }
                }
                if ($isExit == false) {
                    $item = [
                        "name" => $row[7],
                        "quantity" => $row[4],
                        "price" => $row[9],
                        "discount" => round($row[16]),
                        "ppn" => $row[18],
                    ];
                    if (isset($row[2])) {
                        $date = strtodate($row[2]);
                    }
                    if ($row[8] == "WHATSAPP ORDER") {
                        $row[8] = "WO";
                    }
                    if ($row[8] == "ESQA WEBSITE") {
                        $row[8] = "WEBSITE";
                    }
                    $data = [
                        "channel_order_id" => "${row[1]}",
                        "channel_name" => $row[8],
                        "order_date" => $date,
                        "items" => [
                            $item,
                        ],
                        "total" => $row[6],
                    ];
                    $datas[] = $data;
                }
            }
        }

        // $result = [];
        // for ($i = 0; $i < count($datas); $i++) {
        //     $result[] = $datas[$i];
        // }
        // $pdf = app()->make('dompdf.wrapper');
        // $pdf->loadView('pdf.invoice', ['datas' => $result])->setPaper('a4', 'portrait');
        // return $pdf->stream();
        return view('pdf.invoice', ['datas' => $datas]);
    }
}
