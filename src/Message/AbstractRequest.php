<?php

namespace Omnipay\CoinBase\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    protected $endpoint = 'https://api.commerce.coinbase.com/';

    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getAccountId()
    {
        return $this->getParameter('accountId');
    }

    public function setAccountId($value)
    {
        return $this->setParameter('accountId', $value);
    }

    public function getName()
    {
        return $this->getParameter('name');
    }

    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function getPricingType()
    {
        return $this->getParameter('pricing_type');
    }

    public function setPricingType($value)
    {
        return $this->setParameter('pricing_type', $value);
    }

    public function getLocalPrice()
    {
        return $this->getParameter('local_price');
    }

    public function setLocalPrice($value)
    {
        return $this->setParameter('local_price', $value);
    }
    protected function getItemData()
    {
        $data = array();
        return $data;
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ?  $this->endpoint : $this->endpoint;
    }

    public function sendData($data)
    {
        $body = $data ? json_encode($data) : null;

        $headers = [];
        $headers['X-CC-Api-Key'] = $this->getApiKey();
        $headers['X-CC-Version'] = "";
        $headers['Content-Type'] = 'application/json';

        $httpresponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);
        var_dump($httpresponse->getBody()->getContents());
        var_dump($body);
    }

    public function sendDataNot($data)
    {
        $body = $data ? json_encode($data) : null;
        $url = $this->endpoint;

        $headers = [];
        $headers['CB-ACCESS-KEY'] = $this->getApiKey();
        $headers['CB-ACCESS-SIGN'] = $this->generateSignature($url, $body, false, $this->getHttpMethod());
        $headers['CB-ACCESS-TIMESTAMP'] = time();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';

        if ($this->getHttpMethod() == 'POST') {
            $headers['Content-Type'] = 'application/json';
        }

        $httpresponse = $this->httpClient->request($this->getHttpMethod(), $this->getEndpoint(), $headers, $body);

        var_dump($httpresponse->getBody()->getContents());
        // return $this->response = $this->createResponse(json_decode($httpresponse->getBody()->getContents(), true), $httpresponse->getStatusCode());  
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }

    public function generateSignature($request_path = '', $body = '', $timestamp = false, $method = 'GET')
    {
        $body = is_array($body) ? json_encode($body) : $body;
        $timestamp = $timestamp ? $timestamp : time();

        $what = $timestamp . $method . $request_path . $body;

        return base64_encode(hash_hmac("sha256", $what, base64_decode($this->getSecret()), true));
    }
}
