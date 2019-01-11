<?php
/**
 * @package     CMH
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Helper;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_DELIVERYTIME_API = 'deliverytime/general/api';
    const XML_PATH_DELIVERYTIME_PACKAGETIME = 'deliverytime/general/packagetime';
    const XML_PATH_DELIVERYTIME_WAREHOUSE = 'deliverytime/general/warehouse';


    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    public function getApiKey() {
        return json_encode($this->scopeConfig->getValue(self::XML_PATH_DELIVERYTIME_API, ScopeConfigInterface::SCOPE_TYPE_DEFAULT), true);
    }


    public function getPackageTime() {
        return json_encode($this->scopeConfig->getValue(self::XML_PATH_DELIVERYTIME_PACKAGETIME, ScopeConfigInterface::SCOPE_TYPE_DEFAULT), true);
    }

    public function getWareHouseAddress() {
        return json_encode($this->scopeConfig->getValue(self::XML_PATH_DELIVERYTIME_WAREHOUSE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT), true);
    }
}