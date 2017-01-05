<?php
namespace AVATOR\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Class Index
 * @package AVATOR\ContactUs\Controller\Adminhtml\Contact
 */
class Index extends \Magento\Backend\App\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }


    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AVATOR_ContactUs::contact');
        $resultPage->addBreadcrumb(__('Contact us'), __('Contact us'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact us'));

        return $resultPage;
    }

    /**
     * Check permission for passed action
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AVATOR_ContactUs::contact');
    }
}
