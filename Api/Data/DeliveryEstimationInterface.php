<?php
/**
 * Created by PhpStorm.
 * User: vijay
 * Date: 11/01/19
 * Time: 1:02 PM
 */

namespace Codilar\DeliveryTimeEstimation\Api\Data;



interface DeliveryEstimationInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'entity_id';
    const CUSTOMER_ID = 'customer_id';
    const ORDER_ID = 'order_id';
    const TO_ADDRESS = 'to_address';
    const DISTANCE = 'distance';
    const DELIVERY_TIME = 'delivery_time';
    const CALCULATED_TIME = 'calculated_time';


    /**
     * @return integer
     */
    public function getEntityId();

    /**
     * @param $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * @return integer
     */

    public function getCustomerId();

    /**
     * @param $customerId
     * @return mixed
     */
    public function setCustomerId($customerId);

    /**
     * @return integer
     */

    public function getOrderId();

    /**
     * @param $orderId
     * @return mixed
     */

    public function setOrderId($orderId);

    /**
     * @return string
     */
    public function getToAddress();

    /**
     * @param $toAddress
     * @return mixed
     */
    public function setToAddress($toAddress);

    /**
     * @return string
     */
    public function getDistance();

    /**
     * @param $distance
     * @return mixed
     */
    public function setDistance($distance);

    /**
     * @return string
     */
    public function getDeliveryTime();

    /**
     * @param $deliveryTime
     * @return mixed
     */
    public function setDeliveryTime($deliveryTime);

    /**
     * @return string
     */
    public function getCalculatedTime();

    /**
     * @param $calculatedTime
     * @return mixed
     */
    public function setCalculatedTime($calculatedTime);



}