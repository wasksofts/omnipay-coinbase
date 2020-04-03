<?php

namespace Omnipay\CoinBase\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

    protected $endpoint ='https://api.commerce.coinbase.com/';

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

    public function getRequestedInfo()
    {
        return $this->getParameter('requested_info');
    }

    public function setRequestedInfo($value)
    {
        return $this->setParameter('requested_info', $value);
    }

    public function getRedirectUrl()
    {
        return $this->getParameter('redirect_url');
    }

    public function setRedirectUrl($value)
    {
        return $this->setParameter('redirect_url', $value);
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

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new PurchaseResponse($this, $data, $statusCode);
    }

  
}
