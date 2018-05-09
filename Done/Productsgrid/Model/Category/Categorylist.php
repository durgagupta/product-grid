<?php
namespace Done\Productsgrid\Model\Category;

class Categorylist implements \Magento\Framework\Option\ArrayInterface
{

    /**
     *
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory            
     */
    public function __construct(\Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $collectionFactory)
    {
        $this->_categoryCollectionFactory = $collectionFactory;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Magento\Framework\Data\OptionSourceInterface::toOptionArray()
     */
    public function toOptionArray($addEmpty = true)
    {
        
        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $collection */
        $collection = $this->_categoryCollectionFactory->create();
        
        $collection->addAttributeToSelect('name'); // ->addRootLevelFilter()->load();
        
        $options = [];
        
        if ($addEmpty) {
            $options[] = [
                'label' => __('-- Please Select a Category --'),
                'value' => ''
            ];
        }
        foreach ($collection as $category) {
            $options[] = [
                'label' => $category->getName(),
                'value' => $category->getId()
            ];
        }
        
        return $options;
    }
}
