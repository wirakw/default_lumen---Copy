<?php

namespace App\Traits;
use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $url, $postFields = [], $header = [])
    {
        if (empty($header)) {
            $header = [
                'Content-Type' => 'application/json',
            ];
        }
        $client = new Client([
            // 'headers' => $header,
            'verify' => false,
        ]);
        try {
            $response = $client->request($method, $this->baseUri.$url,[
                'body' => json_encode($postFields),
                'headers'     => $header,
            ]);
            
            $data = json_decode($response->getBody()->getContents(), true);
            $code = $response->getStatusCode();
            $result = [
                "data" => $data,
                "code" => $code,
            ];
        } catch (\GuzzleHttp\Exception\TooManyRedirectsException $e) {
            // handle too many redirects
        } catch (\GuzzleHttp\Exception\ClientException | \GuzzleHttp\Exception\ServerException $e) {
            // ClientException - A GuzzleHttp\Exception\ClientException is thrown for 400 level errors if the http_errors request option is set to true.
            // ServerException - A GuzzleHttp\Exception\ServerException is thrown for 500 level errors if the http_errors request option is set to true.
            if ($e->hasResponse()) {
                // is HTTP status code, e.g. 500
                $code = $e->getResponse()->getStatusCode();
                $response = $e->getResponse();
                $data = json_encode(json_decode($response->getBody()->getContents(), true));
                $result = [
                    "data" => $data,
                    "code" => $code,
                ];
            }
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            // ConnectException - A GuzzleHttp\Exception\ConnectException exception is thrown in the event of a networking error. This may be any libcurl error, including certificate problems
            $handlerContext = $e->getHandlerContext();
            if ($handlerContext['errno'] ?? 0) {
                // this is the libcurl error code, not the HTTP status code!!!
                // for example 6 for "Couldn't resolve host"
                $errno = (int) ($handlerContext['errno']);
            }
            // get a description of the error (which will include a link to libcurl page)
            $errorMessage = $handlerContext['error'] ?? $e->getMessage();

            $result = [
                "data" => $errorMessage,
                "code" => 0,
            ];
        } catch (\Exception $e) {
            $errorMessage = $handlerContext['error'] ?? $e->getMessage();

            $result = [
                "data" => $errorMessage,
                "code" => 0,
            ];
            // fallback, in case of other exception
        }
        return $result;
    }
}