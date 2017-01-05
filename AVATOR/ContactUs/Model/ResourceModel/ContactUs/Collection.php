<?php
namespace AVATOR\ContactUs\Model\ResourceModel\ContactUs;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */
/**
 * Class Collection
 * @package AVATOR\ContactUs\Model\ResourceModel\ContactUs
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AVATOR\ContactUs\Model\ContactUs', 'AVATOR\ContactUs\Model\ResourceModel\ContactUs');
    }
}
