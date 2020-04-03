<?php

namespace Omnipay\CoinBase\Message;

class PurchaseRequest extends AbstractRequest
{
    
    public function getData()
    {
        $this->validate('name', 'description', 'amount', 'currency', 'pricing_type');
        $data = [];

        $data['name'] = $this->getName();
        $data['description']  =  $this->getDescription();
        $data['pricing_type'] = $this->getPricingType();
        $data['redirect_url'] = $this->getRedirectUrl();

        if ($data['pricing_type'] === "fixed_price") {
            $data['local_price']  = [
                'amount' => $this->getAmount(),
                'currency' => $this->getCurrency()
            ];
        }

        $data['requested_info']  = $this->getRequestedInfo();
        return $data;
    }

    public function sendData($data)
    {
        $body = $data ? json_encode($data) : null;
        $requestUrl =  $this->getEndpoint();
        $headers = [];

        $headers['X-CC-Api-Key'] = $this->getApiKey();
        $headers['X-CC-Version'] = "2019-11-15";
        $headers['Content-Type'] = 'application/json';
        $httpresponse = $this->httpClient->request($this->getHttpMethod(), $requestUrl, $headers, $body);

        return $this->response = $this->createResponse(json_decode($httpresponse->getBody()->getContents(), true), $httpresponse->getStatusCode());
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . 'charges/';
    }
}
