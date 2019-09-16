<?php
namespace Omnipay\Pagonline\Message;

use Omnipay\Pagonline\Message\AbstractRequest;
use Omnipay\Pagonline\Message\PurchaseResponse;
use Omnipay\Common\Message\ResponseInterface;


class PurchaseRequest extends AbstractRequest
{
	
	public function getData(){

		$this->validate('tid', 'kSig', 'shopID', 'currencyCode', 'amount', 'langID', 'errorURL', 'notifyURL');
		$data = $this->getDefaultParameters();
		 return $data += [
		 		'serverURL'=>$this->getEndpoint()
				,'tid'=>$this->getTid()
				,'kSig'=>$this->getSecretKey()
				,'shopID'=>$this->getTransactionId()
				,'currencyCode'=>$this->getCurrency()
				,'amount'=>$this->getAmount() * 100
				,'shopUserRef'=>$this->getEmail()
				,'shopUserName'=>$this->getFullName()
				,'shopUserAccount'=>$this->getFullName()
				,'langID'=>$this->getLanguage()
				,'notifyURL'=>$this->getReturnUrl()
				,'errorURL'=>$this->getCancelUrl()
		 		,'paymentReason'=>$this->getDescription()
		];
	}
    public function sendData($data)
    {
    	
    	$this->IgfsClient = new \IgfsCgInit();
    	foreach($data as $key=>$values){
    		$this->IgfsClient->{$key} = $values;
    	}
    	
    	// ====================================================================
    	// =              esecuzione richiesta di inizializzazione            =
    	// ====================================================================
    	
    	if (!$this->IgfsClient->execute()) {
    		$this->_message = $this->IgfsClient->errorDesc;
    		$this->_error = $this->IgfsClient->rc;
    	}
    	return $this->response = new PurchaseResponse($this, $data);
    }
}
