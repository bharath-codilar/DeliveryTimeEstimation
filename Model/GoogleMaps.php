<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Model;


use Codilar\DeliveryTimeEstimation\Api\GoogleMapsInterface;
use Codilar\DeliveryTimeEstimation\Helper\Data;
use Codilar\DeliveryTimeEstimation\Helper\Address;
use Psr\Log\LoggerInterface;

class GoogleMaps implements GoogleMapsInterface
{
    /**
     * @var Data
     */
    private $data;
    /**
     * @var Address
     */
    private $addressHelper;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GoogleMaps constructor.
     * @param Data $data
     * @param Address $addressHelper
     * @param LoggerInterface $logger
     */
    public function __construct(
        Data $data,
        Address $addressHelper,
        LoggerInterface $logger
    )
    {
        $this->data = $data;
        $this->addressHelper = $addressHelper;
        $this->logger = $logger;
    }

    public function getLocation($address)
    {
        $finalAddress = $this->addressHelper->getAddressString($address);
        $result = str_replace(' ', '+', $finalAddress);
        $result = str_replace("\n", '+', $result);
        return $this->getApiData($result);
    }

    public function getApiData($destination)
    {
        $apiKey = $result = str_replace('"', '', $this->data->getApiKey());
        $warehouseAddress = str_replace('"', '', $this->data->getWareHouseAddress());
        $origin = str_replace(' ', '+', $warehouseAddress);
//        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=".$apiKey;
        $url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$origin."&destination=".$destination."&key=".$apiKey;
        $this->logger->info($url);
        $mapsApi = curl_init($url);
        curl_setopt($mapsApi, CURLOPT_RETURNTRANSFER, true);
        $mapsData = curl_exec($mapsApi);

        return \json_decode($mapsData, true);
    }
}