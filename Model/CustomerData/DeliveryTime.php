<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Model\CustomerData;


use Codilar\DeliveryTimeEstimation\Helper\Data;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Checkout\Model\Session;
use Psr\Log\LoggerInterface;
use Codilar\DeliveryTimeEstimation\Api\GoogleMapsInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Quote\Api\CartRepositoryInterface;

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
     * @var GoogleMapsInterface
     */
    private $googleMaps;
    /**
     * @var Data
     */
    private $data;
    /**
     * @var TimezoneInterface
     */
    private $timezone;
    /**
     * @var CartRepositoryInterface
     */
    private $quoteRepository;

    /**
     * DeliveryTime constructor.
     * @param Session $checkoutSession
     * @param LoggerInterface $logger
     * @param Data $data
     * @param GoogleMapsInterface $googleMaps
     * @param TimezoneInterface $timezone
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        Session $checkoutSession,
        LoggerInterface $logger,
        Data $data,
        GoogleMapsInterface $googleMaps,
        TimezoneInterface $timezone,
        CartRepositoryInterface $quoteRepository
     )
    {
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->googleMaps = $googleMaps;
        $this->data = $data;
        $this->timezone = $timezone;
        $this->quoteRepository = $quoteRepository;
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
        $response = $this->googleMaps->getLocation($address);
//        $travelTime = $response['rows'][0]['elements'][0]['duration']['text'];
        $latitude = $response['routes'][0]['legs'][0]['end_location']['lat'];
        $longitude = $response['routes'][0]['legs'][0]['end_location']['lng'];
        $this->saveLatLong($latitude, $longitude);
        $travelTime = $response['routes'][0]['legs'][0]['duration']['text'];
//        $travelTime =  "1 hour 30 mins";
        $passVariables['time'] = $this->getTotalDeliveryTime($travelTime);
        return $passVariables;
    }

    public function getTotalDeliveryTime($travelTime) {
        $totalPackingTime = $this->getTotalPackingTime()." mins";
        $currentTime = $this->timezone->date()->format('h:i:s A');
        $totalTime = strtotime( $travelTime, strtotime($totalPackingTime, strtotime($currentTime)));
        return date('h:i A', $totalTime);
    }

    public function getTotalPackingTime() {
        $qty = $this->checkoutSession->getQuote()->getItemsQty();
        $packingTime = (int)str_replace('"', '', $this->data->getPackageTime());
        return $qty * $packingTime;
    }

    public function saveLatLong($latitude, $longitude) {
        $quote = $this->checkoutSession->getQuote();
        $quote->setData('latitude', $latitude);
        $quote->setData('longitude', $longitude);
        $this->quoteRepository->save($quote);
    }
}