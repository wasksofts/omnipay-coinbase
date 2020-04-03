<?php

namespace Omnipay\CoinBase\Message;

class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
    }

    public function sendData($data)
    {
        $body = $data ? json_encode($data) : null;
        $url = $this->getEndpoint() . 'user/';

        $headers = [];
        $headers['CB-ACCESS-KEY'] = $this->getApiKey();
        $headers['CB-ACCESS-SIGN'] = $this->generateSignature($url, $body, time(), $this->getHttpMethod());
        $headers['CB-ACCESS-TIMESTAMP'] = time();
        $headers['Content-Type'] = 'application/json';

        $httpresponse = $this->httpClient->request($this->getHttpMethod(), $url, $headers, $body);
        var_dump($httpresponse->getBody()->getContents());
        // return $this->response = $this->createResponse(json_decode($httpresponse->getBody()->getContents(), true), $httpresponse->getStatusCode());
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function getEndpoint()
    {
        return  'https://api.coinbase.com/v2/';
    }

    public function generateSignature($request_path = '', $body = '', $timestamp = false, $method = 'GET')
    {
        $body = is_array($body) ? json_encode($body) : $body;
        $timestamp = $timestamp ? $timestamp : time();

        $what = $timestamp . $method . $request_path . $body;

        return base64_encode(hash_hmac("sha256", $what, base64_decode($this->getSecret()), true));
    }
}
