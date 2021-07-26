<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDF;

class InvoiceController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
    
}