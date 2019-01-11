<?php
/**
 * Created by PhpStorm.
 * User: vijay
 * Date: 10/01/19
 * Time: 1:09 PM
 */

namespace Codilar\DeliveryTimeEstimation\Model;
use  Codilar\DeliveryTimeEstimation\Api\Data\DeliveryEstimationInterface;

class DeliveryEstimation extends \Magento\Framework\Model\AbstractModel implements DeliveryEstimationInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'delivery_estimation';

    /**
     * @var string
     */
    protected $_cacheTag = 'delivery_estimation';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'delivery_estimation';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Codilar\DeliveryTimeEstimation\Model\ResourceModel\DeliveryEstimation');
    }

    /**
     * @return int|mixed
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }


    /**
     * @param int $entityId
     * @return DeliveryEstimation|\Magento\Framework\Model\AbstractModel|mixed
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @return integer
     */
    public function getCustomerId()
    {
        // TODO: Implement getCustomerId() method.
        return $this->getData(self::CUSTOMER_ID);

    }

    /**
     * @param $customerId
     * @return mixed
     */
    public function setCustomerId($customerId)
    {
        // TODO: Implement setCustomerId() method.
        return $this->setData(self::CUSTOMER_ID, $customerId);

    }

    /**
     * @return integer
     */
    public function getOrderId()
    {
        // TODO: Implement getOrderId() method.
        return $this->getData(self::ORDER_ID);

    }

    /**
     * @param $orderId
     * @return mixed
     */
    public function setOrderId($orderId)
    {
        // TODO: Implement setOrderId() method.
        return $this->setData(self::ORDER_ID, $orderId);

    }

    /**
     * @return string
     */
    public function getToAddress()
    {
        // TODO: Implement getToAddress() method.
        return $this->getData(self::TO_ADDRESS);

    }

    /**
     * @param $toAddress
     * @return mixed
     */
    public function setToAddress($toAddress)
    {
        // TODO: Implement setToAddress() method.
        return $this->setData(self::TO_ADDRESS, $toAddress);

    }

    /**
     * @return string
     */
    public function getDistance()
    {
        // TODO: Implement getDistance() method.
        return $this->getData(self::DISTANCE);

    }

    /**
     * @param $distance
     * @return mixed
     */
    public function setDistance($distance)
    {
        // TODO: Implement setDistance() method.
        return $this->setData(self::DISTANCE,$distance);

    }

    /**
     * @return string
     */
    public function getDeliveryTime()
    {
        // TODO: Implement getDistanceTime() method.
        return $this->getData(self::DELIVERY_TIME);

    }

    /**
     * @param $deliveryTime
     * @return mixed
     */
    public function setDeliveryTime($deliveryTime)
    {
        // TODO: Implement setDistanceTime() method.
        return $this->setData(self::DELIVERY_TIME,$deliveryTime);

    }

    /**
     * @return string
     */
    public function getCalculatedTime()
    {
        // TODO: Implement getCalculatedTime() method.
        return $this->getData(self::CALCULATED_TIME);

    }

    /**
     * @param $calculatedTime
     * @return mixed
     */
    public function setCalculatedTime($calculatedTime)
    {
        // TODO: Implement setCalculatedTime() method.
        return $this->setData(self::CALCULATED_TIME,$calculatedTime);

    }
}