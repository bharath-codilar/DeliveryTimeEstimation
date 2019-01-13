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

    public function getTotalDeliveryTime($travelTimeDuration) {
        $packingTimeDuration = $this->getTotalPackingTimeDuration();
        $currentDate = (int)$this->getCurrentDateTime()->format('d');
        $currentTime = $this->getCurrentDateTime();
        $totalTime = $currentTime;
        $totalTime = $currentTime->add(new \DateInterval('PT'.$packingTimeDuration.'M'));

        preg_match_all('!\d+!', $travelTimeDuration, $values);
        $values = $values[0];

        preg_match_all('/([a-zA-Z]|xC3[x80-x96x98-xB6xB8-xBF]|xC5[x92x93xA0xA1xB8xBDxBE]){3,}/', $travelTimeDuration, $labels);
        $labels = $labels[0];

        $finalarray = array_merge_recursive($labels,$values);

        for ($x=0; $x <= count($finalarray)/2-1; $x++) {
            if ($finalarray[$x] === 'min' || $finalarray[$x] === 'mins') {
                $totalTime = $totalTime->add(new \DateInterval('PT'.$finalarray[$x+count($finalarray)/2].'M'));
            } elseif ($finalarray[$x] === 'hour' || $finalarray[$x] === 'hours') {
                $totalTime = $totalTime->add(new \DateInterval('PT'.$finalarray[$x+count($finalarray)/2].'H'));
            } elseif ($finalarray[$x] === 'day' || $finalarray[$x] === 'days') {
                $totalTime = $totalTime->add(new \DateInterval('P'.$finalarray[$x+count($finalarray)/2].'D'));
            }
        }

        if ($currentDate < $totalTime->format('d')) {
            return "Your courier will be delivered by Tomorrow at ".$this->getWareHouseOpeningTime() ."'o clock";
        } else {
            return $totalTime->format('d H:i:s');
        }
    }

    public function getCurrentDateTime() {
        return $this->timezone->date();
    }

    public function getWareHouseOpeningTime() {
        return (int)str_replace('"', '', $this->data->getWareHouseTimeOpen());
    }

    public function getWareHouseClosingTime() {
        return (int)str_replace('"', '', $this->data->getWareHouseTimeClose());
//        return $this->data->getWareHouseTimeClose();
    }

    public function getTotalPackingTimeDuration() {
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