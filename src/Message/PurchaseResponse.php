<?php

namespace Omnipay\CoinBase\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Coinbase Purchase Response
 */
class PurchaseResponse extends Response implements RedirectResponseInterface
{
    protected $redirectEndpoint = 'https://coinbase.com/checkouts';

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        // /$this->data['data']['code']
        return isset($this->data['data']['hosted_url']);
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }


    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return $this->data['data']['hosted_url'];
        }
    }

    public function getRedirectData()
    {
        return;
    }

    public function getMessage()
    {
        if (isset($this->data['error']['message'])) {
            return $this->data['error']['type'] . ': ' . $this->data['error']['message'];
        }
    }

    public function getTransactionReference()
    {
        if (isset($this->data['button']['code'])) {
            return $this->data['button']['code'];
        }
    }
}
