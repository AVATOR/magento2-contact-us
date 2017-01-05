<?php
namespace AVATOR\ContactUs\Block\Adminhtml\Contact;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */
/**
 * Class Edit
 * @package AVATOR\ContactUs\Block\Adminhtml\Contact
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize ContactUs edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'AVATOR_ContactUs';
        $this->_controller = 'adminhtml_contact';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save'));

        $this->buttonList->remove('delete');
    }

    /**
     * Retrieve text for header element depending on loaded contactus
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Save');
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
