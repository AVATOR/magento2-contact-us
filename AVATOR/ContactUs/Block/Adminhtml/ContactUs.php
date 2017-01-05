<?php
namespace AVATOR\ContactUs\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Class ContactUs
 * @package AVATOR\News\Block\Adminhtml
 */
class ContactUs extends Container
{

    /**
     * Initialize object
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_contactus';
        $this->_blockGroup = 'AVATOR_ContactUs';
        $this->_headerText = __('Contact us');

        parent::_construct();

        $this->buttonList->remove('add');
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
