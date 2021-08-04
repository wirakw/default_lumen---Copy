<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class AturTokoService
{
    use ConsumeExternalService;

    /**
     * The base uri to consume authors service
     * @var string
     */
    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.aturtoko.base_uri');
    }

    public function login($data)
    {
        return $this->performRequest('POST', '/authorize_admin', $data);
    }

    public function getToken($data)
    {
        return $this->performRequest('POST', '/accesstoken', $data);
    }

    public function getListOrder($data, $header)
    {
        return $this->performRequest('POST', '/list_order', $data, $header);
    }

    public function getOrderDetail($data, $header)
    {
        return $this->performRequest('POST', '/detail_order', $data, $header);
    }
}