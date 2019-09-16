<?php
namespace Omnipay\Pagonline\Message;

use Omnipay\Pagonline\Message\AbstractRequest;
use Omnipay\Pagonline\Message\CompletePurchaseResponse;
use Omnipay\Common\Message\ResponseInterface;


class CompletePurchaseRequest extends AbstractRequest
{
	public function getData(){
		$this->validate('tid', 'kSig', 'shopID', 'currencyCode', 'amount', 'langID', 'errorURL', 'notifyURL');
		$data = $this->getDefaultParameters();
		return $data += [
				'serverURL'=>$this->getEndpoint()
				,'tid'=>$this->getTid()
				,'kSig'=>$this->getSecretKey()
				,'shopID'=>$this->getTransactionId()
				,'paymentID'=>$this->getPaymentTransactionId()
		];

	}
    public function sendData($data)
    {
    	$this->IgfsClient = new \IgfsCgVerify();
    	
    	foreach($data as $key=>$values){
    		$this->IgfsClient->{$key} = $values;
    	}
    	$this->IgfsClient->execute();
    	
    	$this->_message = $this->IgfsClient->errorDesc;
    	$this->_error = $this->IgfsClient->rc;
    	
    	$_logFields = array('paymentID','amount','refTranID','tranID','authCode','enrStatus','authStatus','brand','acquirerID','payInstrToken','expireMonth','expireYear','level3Info','status','accountName','nssResult','topUpID','receiptPdf','shopID','rc','error','errorDesc');
    	foreach($_logFields as $i => $key){
    		if(isset($this->IgfsClient->{$key})){
	    		$data[$key] = $this->IgfsClient->{$key};
    		}
    	}  
    	return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
