<?php
namespace Omnipay\Pagonline\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Dummy Response
 *
 * This is the response class for all Pagonline purchase requests.
 *
 * @see \Omnipay\Pagonline\Gateway
 */
class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
    	return false ;
    }

    public function getMessage()
    {
    	return $this->getRequest()->getMessage();
    }
    public function isRedirect()
    {
    	return  is_null(($this->getRequest()->getError()));
    }
    public function getRedirectUrl()
    {
    	return $this->getRequest()->getClient()->redirectURL;
    }
    public function getTransactionReference()
    {
    	return $this->getRequest()->getClient()->paymentID;
    }
 
}
