<?php
namespace AVATOR\ContactUs\Model\ResourceModel;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */
/**
 * Class ContactUs
 * @package AVATOR\ContactUs\Model\ResourceModel
 */
class ContactUs extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\AVATOR\ContactUs\Model\ContactUs::TABLE_NAME, 'id');
    }
}
