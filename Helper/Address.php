<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Helper;


use Magento\Framework\App\Helper\AbstractHelper;

class Address extends AbstractHelper
{
    public function getAddressString($address)
    {
        /** @var \Magento\Quote\Model\Quote\Address $address */
        $fullAddress = preg_replace('/#/', '', $address->getStreetFull()).' '.$address->getCity().' '.$address->getPostcode();
        return $fullAddress;
    }
}