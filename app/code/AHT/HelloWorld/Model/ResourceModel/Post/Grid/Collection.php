<?php
namespace AHT\HelloWorld\Model\ResourceModel\Post\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'user_id';
    protected $_eventPrefix = 'aht_helloworld_post_grid_collection';
    protected $_eventObject = 'post_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\HelloWorld\Model\Post\Grid', 'AHT\HelloWorld\Model\ResourceModel\Post\Grid');
    }
}
