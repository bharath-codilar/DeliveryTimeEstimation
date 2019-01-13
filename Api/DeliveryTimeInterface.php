<?php
/**
 * @package     CMH
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Api;


interface DeliveryTimeInterface
{
    /**
     * @return string
     */
    public function latlong();
}