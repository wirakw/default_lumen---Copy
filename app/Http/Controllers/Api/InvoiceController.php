<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use App\Services\AturTokoService;
// use Cache;

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
            "marketplace"=> [],
            "status" =>[
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
                "COM"
            ],
            "from" => 1625072400000,
            "to" => 1627664400000,
            "orderby" => "order_id",
            "order" => "asc",
            "page" => 0,
            "size" =>  10,
            "query" =>  ""
        ];
        $header = [
            "X-Access-Token" => $token,
            'Content-Type' => 'application/json',
        ];
        $orderList = $this->atService->getListOrder($req, $header)['data']['data'];
        $invoices = [];
        foreach ($orderList as $orderData) {
            $reqDetail = [
                "order_id" => $orderData["channel_order_id"]
            ];
            $invoices[] = $this->atService->getOrderDetail($reqDetail, $header)['data']['data'];
        }

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['datas' => $invoices])->setPaper('a4', 'portrait');
        return $pdf->stream();
        // return response()->json($generates, 200);
    }
    
}