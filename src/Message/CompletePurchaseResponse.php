<?php
namespace Omnipay\Pagonline\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * CompletePurchase Response
 *
 * This is the response class for all Pagonline CompletePurchase requests.
 *
 * @see \Omnipay\Pagonline\Gateway
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
    	RETURN TRUE;
    	return  (is_null(($this->getRequest()->getError())) || $this->getRequest()->getError() == 'IGFS_000' ) ? true : false;
    }

    public function getMessage()
    {
    	$message = $this->getRequest()->getHttpRequest()->query->get('messaggio');
    	return  (!empty($message)) ?  $message: null;
    }
    public function getTransactionReference()
    {
    	return $this->getRequest()->getPaymentTransactionId();
    }
}
