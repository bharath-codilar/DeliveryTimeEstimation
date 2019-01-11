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
use Codilar\DeliveryTimeEstimation\Helper\MapsApi;

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
     * @var MapsApi
     */
    private $mapsApi;

    /**
     * DeliveryTime constructor.
     * @param Session $checkoutSession
     * @param LoggerInterface $logger
     * @param MapsApi $mapsApi
     */
    public function __construct(
        Session $checkoutSession,
        LoggerInterface $logger,
        MapsApi $mapsApi
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->mapsApi = $mapsApi;
    }

    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        /** @var \Magento\Quote\Model\Quote\Address $address */
        $address = $this->checkoutSession->getQuote()->getShippingAddress();
        $this->logger->info($address->getPostcode());
        $fullAddress = preg_replace('/#/', '', $address->getStreetFull()).' '.$address->getCity().' '.$address->getPostcode();
        $result = str_replace(' ', '+', $fullAddress);
        $result = str_replace("\n", '+', $result);
        $this->logger->info((string)$fullAddress);
        $this->logger->info((string)$result);
        $apiData = $this->mapsApi->getCustomerLocation($result);
        $passVariables['distance'] = $apiData['routes'][0]['legs'][0]['distance']['text'];
//        $passVariables['time'] = $apiData['routes'][0]['legs'][0]['duration']['text'];
        $passVariables['time'] = "Ti
        return $passVariables;
    }
}