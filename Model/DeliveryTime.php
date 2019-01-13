<?php
/**
 * @package     CMH
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Model;


use Codilar\DeliveryTimeEstimation\Api\DeliveryTimeInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Codilar\DeliveryTimeEstimation\Helper\Address;

class DeliveryTime implements DeliveryTimeInterface
{
    /**
     * @var CollectionFactory
     */
    private $orderCollectionFactory;
    /**
     * @var Address
     */
    private $addressHelper;

    /**
     * DeliveryTime constructor.
     * @param CollectionFactory $orderCollectionFactory
     * @param Address $addressHelper
     */
    public function __construct(
        CollectionFactory $orderCollectionFactory,
        Address $addressHelper
    )
    {
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->addressHelper = $addressHelper;
    }

    /**
     * @return string
     */
    public function getOrderDetails()
    {
        $orders = $this->orderCollectionFactory->create();
        $orderData = $orders->addFieldToFilter('status', 'complete')->load();
        $response['store'] = array(
            "store" => "Codilar Technologies",
            "latitude" => "12.9161° N",
            "longitude" => "77.6156° E"
        );
        $arr = array();
        /** @var  \Magento\Sales\Model\Order $order */
        foreach ($orderData as $order) {
            $arr[$order->getId()] = array(
                "oder_id" => $order->getId(),
              "customer_name" => $order->getCustomerName(),
                "latitude" => $order->getData('latitude'),
                "longitude" => $order->getData('longitude')
            );
        }
        $response['orders'] = $arr;

//        return json_encode($response);
        return $response;
    }
}