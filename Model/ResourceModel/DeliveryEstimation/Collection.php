<?php

namespace Codilar\DeliveryTimeEstimation\Model\ResourceModel\DeliveryEstimation;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Codilar\DeliveryTimeEstimation\Model\DeliveryEstimation', 'Codilar\DeliveryTimeEstimation\Model\ResourceModel\DeliveryEstimation');
    }
}