<?php
namespace Omnipay\Pagonline;

require_once(dirname(__FILE__) . "/Igfs/init/IgfsCgInit.php");
require_once(dirname(__FILE__) . "/Igfs/init/IgfsCgVerify.php");
use Omnipay\Common\AbstractGateway;

/**
 * Pagonline Gateway
 *
MasterCard
5256103270096532
Scadenza:04/19
cvv: 241

VISA
4824983270096509
scadenza:04/19
cvv: 472

URL back office

https://testeps.netswgroup.it/UNI_CG_BO_WEB
User ID: UNIBO
Password: UniBo2014
 */
class Gateway extends AbstractGateway
{
	
    public function getName()
    {
        return 'Pagonline';
    }
    /**
     * Get the gateway alias.

     *
     * @return string
     */
    public function getTid()
    {
    	return $this->getParameter('tid');
    }
    /**
     * Set tid
     *
     * @param  string $value
     * @return Gateway provides a fluent interface.
     */
    public function setTid($value)
    {
    	return $this->setParameter('tid', $value);
    }
 
    public function getSecretKey()
    {
    	return $this->getParameter('kSig');
    }
    /**
     * Set kSig
     *
     * @param  string $value
     * @return Gateway provides a fluent interface.
     */
    public function setSecretKey($value)
    {
    	return $this->setParameter('kSig', $value);
    }


    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Pagonline\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Pagonline\Message\CompletePurchaseRequest', $parameters);
    }
}
