<?php

namespace AVATOR\ContactUs\Model;

use Magento\Framework\Model\AbstractModel;

class ContactUs extends AbstractModel
{

    /**
     * Table name
     */
    const TABLE_NAME = 'avator_contactus';

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AVATOR\ContactUs\Model\ResourceModel\ContactUs');
    }
}
