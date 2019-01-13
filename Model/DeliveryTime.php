<?php
/**
 * @package     CMH
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Model;


use Codilar\DeliveryTimeEstimation\Api\DeliveryTimeInterface;
//use Codilar\DeliveryTimeEstimation\Helper\MapsApi;

class DeliveryTime implements DeliveryTimeInterface
{
    /**
     * @var MapsApi
     */
    private $mapsApiHelper;

    /**
     * DeliveryTime constructor.
     * @param MapsApi $mapsApiHelper
     */
    public function __construct(
//        MapsApi $mapsApiHelper
    )
    {
//        $this->mapsApiHelper = $mapsApiHelper;
    }

//    /**
//     * @return string
//     */
    public function latlong()
    {
        return "sdf";
//        return $this->mapsApiHelper->getLatLong();
    }
}