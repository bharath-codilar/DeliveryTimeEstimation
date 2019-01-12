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
//        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=Codilar+Technologies&destinations=745,+5th+main+Srinagara+Bengaluru+560050&key=AIzaSyCgJic5ZawDAttM6EJhShjEzw-CWfBYGyA"
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=".$apiKey;
        $this->logger->info($url);

        /* to do*/
//        $mapsApi = curl_init($url);
//        $mapsData = curl_exec($mapsApi);
        $mapsData = '{
   "destination_addresses" : [
      "745, 5th Main Rd, Srinivasanagara, Hanumanthnagar, Banashankari Stage I, Banashankari, Bengaluru, Karnataka 560019, India"
   ],
   "origin_addresses" : [
      "Sai Manasa, 703, 30th Main Rd, Jayanagar 9th Block East, Kuvempu Nagar, Stage 2, BTM 2nd Stage, Bengaluru, Karnataka 560076, India"
   ],
   "rows" : [
      {
         "elements" : [
            {
               "distance" : {
                  "text" : "5.5 mi",
                  "value" : 8839
               },
               "duration" : {
                  "text" : "32 mins",
                  "value" : 1896
               },
               "status" : "OK"
            }
         ]
      }
   ],
   "status" : "OK"
}';
        return \json_decode($mapsData, true);
    }


}