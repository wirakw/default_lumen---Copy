<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;
use App\Services\AturTokoService;

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

    public function getToken(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $input = $request->all();
        $inputReq['authorization_code'] = $this->atService->login($input)['data']['data']['authorization_code'];
        return response()->json($this->atService->getToken($inputReq), 200);
    }
    
}