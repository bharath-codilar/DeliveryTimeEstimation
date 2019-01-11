<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Block;


use Magento\Framework\View\Element\Template;

class Maps extends Template
{
    public function getApiKey()
    {
//        return "AIzaSyCgJic5ZawDAttM6EJhShjEzw-CWfBYGyA";
        $mapsApi = curl_init("https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyCgJic5ZawDAttM6EJhShjEzw-CWfBYGyA");
        $data = curl_exec($mapsApi);
        return $data;
    }
}