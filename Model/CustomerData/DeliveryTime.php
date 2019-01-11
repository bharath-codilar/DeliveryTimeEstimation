<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Model\CustomerData;


use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Checkout\Model\Session;
use Psr\Log\LoggerInterface;

class DeliveryTime implements ConfigProviderInterface
{
    /**
     * @var Session
     */
    private $checkoutSession;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DeliveryTime constructor.
     * @param Session $checkoutSession
     * @param LoggerInterface $logger
     */
    public function __construct(
        Session $checkoutSession,
        LoggerInterface $logger
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
    }

    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        $address = $this->checkoutSession->getQuote()->getAllShippingAddresses();
        $this->logger->info("bharath");
        /** @var \Magento\Quote\Model\Quote\Address $a */
        foreach ($address as $a) {
            $fullAddress = preg_replace('/#/', '', $a->getStreetFull()).' '.$a->getCity().' '.$a->getPostcode();
            $result = str_replace(' ', '+', $fullAddress);
            $result = str_replace("\n", '+', $result);
            $this->logger->info((string)$fullAddress);
            $this->logger->info((string)$result);
        }
        $passVariables['testData'] = $address;
        return $passVariables;
    }
}