<?php

namespace Omnipay\VirtualMerchant\Message;

/**
 * VirtualMerchant  Authorize Request
 */
class AuthorizeRequest extends AbstractRequest
{
    protected $action = 'ccauthonly';

    public function getData()
    {
        $this->getCard()->validate();
        
        $data = $this->getBaseData();
        $data['ssl_card_number'] = $this->getCard()->getNumber();
        $data['ssl_exp_date'] = $this->getCard()->getExpiryDate('my');
        $data['ssl_cvv2cvc2'] = $this->getCard()->getCvv();
        
        return array_merge($data, $this->getBillingData());
    }
}
