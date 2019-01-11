<?php
/**
 * @package     eat2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\DeliveryTimeEstimation\Controller\Adminhtml\Index;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Model\Export\MetadataProvider;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\Listing\Columns;
use Magento\Framework\Data\OptionSourceInterface;

class GridToCsv extends Action
{
    /**
     * @var Filter
     */
    protected $filter;
    /**
     * @var UiComponentFactory
     */
    private $uiComponentFactory;
    /**
     * @var MetadataProvider
     */
    private $metadataProvider;

    /**
     * GridToCsv constructor.
     * @param Action\Context $context
     * @param Filter $filter
     * @param UiComponentFactory $uiComponentFactory
     * @param MetadataProvider $metadataProvider
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        UiComponentFactory $uiComponentFactory,
        MetadataProvider $metadataProvider
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->uiComponentFactory = $uiComponentFactory;
        $this->metadataProvider = $metadataProvider;
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
        $component = $this->uiComponentFactory->create($this->getRequest()->getParam('namespace'));
        $this->prepareComponent($component);
        $dataProvider = $component->getContext()->getDataProvider();
        $childComponents = $component->getChildComponents();
        /* @var \Magento\Ui\Component\Listing\Columns $columns */
        $columns = null;
        foreach ($childComponents as $childComponent) {
            if ($childComponent instanceof Columns) {
                $columns = $childComponent->getChildComponents();
            }
        }
        if (!$columns) {
            throw new LocalizedException(__("Columns component not found"));
        }


        $data = $component->getDataSourceData();
        $options = [];
        foreach ($columns as $column) {
            /* @var \Magento\Ui\Component\Listing\Columns\Column $column */
            $column->prepareDataSource(['data' => &$data['data']]);
            if ($column->getData('options')) {
                $options[$column->getName()] = $column->getData('options');
            }
        }

        $fields = $this->metadataProvider->getFields($component);
        $headers = $this->metadataProvider->getHeaders($component);
        $rows = [$headers];

        foreach ($data['data']['items'] as $row) {
            $tmpRow = [];
            foreach ($fields as $field) {
                $tmpRow[] = strip_tags(html_entity_decode($this->getOptionValue($options, $field, $row[$field])));
            }
            $rows[] = $tmpRow;
        }
        $this->stream($rows);
    }

    /**
     * @param OptionSourceInterface[] $options
     * @param string $key
     * @param string $value
     * @return string
     */
    protected function getOptionValue($options, $key, $value) {
        if (isset($options[$key])) {
            $currentOptions = $options[$key]->toOptionArray();
            foreach ($currentOptions as $option) {
                if ($option['value'] === $value) {
                    return $option['label'];
                }
            }
        }
        return $value;
    }


    /**
     * Call prepare method in the component UI
     *
     * @param UiComponentInterface $component
     * @return void
     */
    private function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }


    /**
     * @param $rows
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function stream($rows) {
        $filename = $this->filter->getComponent()->getContext()->getNamespace()."_".date("d-m-Y").".csv";
        $output = fopen("php://output", 'w') or die("Can't open php://output");
        header("Content-Type:application/csv");
        header("Content-Disposition:attachment;filename=$filename");
        foreach ($rows as $row) {
            fputcsv($output, $row);
        }
        fclose($output) or die("Can't close php://output");
    }
}