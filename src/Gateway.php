<?php

namespace Omnipay\CoinBase;

use Omnipay\Common\AbstractGateway;

/**
 * CoinBase Gateway
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'CoinBase';
    }

    public function getDefaultParameters()
    {
        return array(
            'apiKey' => '',
            'secret' => '',
            'accountId' => '',
        );
    }

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

    /**
     * @param  array                                     $parameters
     * @return \Omnipay\CoinBase\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinBase\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param  array                                             $parameters
     * @return \Omnipay\Coinbase\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinBase\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param  array                                             $parameters
     * @return \Omnipay\Coinbase\Message\FetchTransactionRequest
     */
    public function fetchTransaction(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\CoinBase\Message\FetchTransactionRequest', $parameters);
    }
}
