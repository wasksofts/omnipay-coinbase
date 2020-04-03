<?php

namespace Omnipay\CoinBase\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
/**
 * Coinbase Response
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return true;
    }

    public function getMessage()
    {
        if (isset($this->data['error']['message'])) {
            return $this->data['error']['message'];
        } elseif (isset($this->data['errors'])) {
            return implode(', ', $this->data['errors']);
        } elseif (isset($this->data['data']['code'])) {
            return $this->data['data']['code'];
        }
    }

    public function getTransactionReference()
    {
        if (isset($this->data['data']['code'])) {
            return $this->data['data']['code'];
        }
    }
}

