<?php
/**
 * @package     hackathon
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Controller\Index;


use Codilar\DeliveryTimeEstimation\Model\CustomerData\DeliveryTime;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;
    /**
     * @var DeliveryTime
     */
    private $deliveryTime;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param DeliveryTime $deliveryTime
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        DeliveryTime $deliveryTime
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->deliveryTime = $deliveryTime;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
//        return $this->pageFactory->create();
        $this->deliveryTime->getTotalDeliveryTime();
//        var_dump($this->deliveryTime->getTotalDeliveryTime());

    }

    public function getMapsData(){
        return "MapsData";
    }
}