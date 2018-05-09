<?php
namespace Done\Productsgrid\Ui\DataProvider\Product;

class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{

    /**
     * {@inheritDoc}
     * @see \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider::addFilter()
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        if ($filter->getField() == 'category_ids') {
            $this->getCollection()->addCategoriesFilter(array(
                'in' => $filter->getValue()
            ));
        } elseif (isset($this->addFilterStrategies[$filter->getField()])) {
            $this->addFilterStrategies[$filter->getField()]->addFilter($this->getCollection(), $filter->getField(), [
                $filter->getConditionType() => $filter->getValue()
            ]);
        } else {
            parent::addFilter($filter);
        }
    }
}
