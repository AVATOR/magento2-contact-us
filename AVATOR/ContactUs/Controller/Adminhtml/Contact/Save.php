<?php
namespace AVATOR\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Class Save
 * @package AVATOR\ContactUs\Controller\Adminhtml\Contact
 */
class Save extends Action
{

    /**
     * Recipient email config path
     */
    const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email';

    /**
     * @var TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Escaper
     */
    protected $_escaper;

    /**
     * Save constructor.
     *
     * @param Context $context
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param Escaper $escaper
     */
    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Escaper $escaper
    ) {
        parent::__construct($context);
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->_escaper = $escaper;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \AVATOR\ContactUs\Model\ContactUs $model */
            $model = $this->_objectManager->create('AVATOR\ContactUs\Model\ContactUs');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'contact_prepare_save',
                ['news' => $model, 'request' => $this->getRequest()]
            );

            try {
                $model->save();

                $this->_sendReplayEmail($data, $model->getData('email'));

                $this->_saveReplayData($data);


                $this->messageManager->addSuccess(__('You saved status and sent message.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @param $data
     * @param $fromEmail
     */
    protected function _sendReplayEmail($data, $fromEmail)
    {
        $this->inlineTranslation->suspend();
        $replayData = [
            'name' => $data['replay_name'],
            'email' => $data['replay_email'],
            'comment' => $data['replay_comment'],
        ];
        $postObject = new \Magento\Framework\DataObject();
        $postObject->setData($replayData);

        $sender = [
            'name' => $this->_escaper->escapeHtml($replayData['name']),
            'email' => $this->_escaper->escapeHtml($replayData['email']),
        ];

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $transport = $this->_transportBuilder
            ->setTemplateIdentifier('send_answer_template')
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                ]
            )
            ->setTemplateVars(['data' => $postObject])
            ->setFrom([
                'email' => $this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope),
                'name' => $replayData['name'],
            ])

            ->addTo($fromEmail)
            ->getTransport();

        $transport->sendMessage();

        $this->inlineTranslation->resume();
    }

    /**
     * @param $data
     */
    protected function _saveReplayData($data)
    {
        $model = $this->objectManager->create('AVATOR\ContactUs\Model\ContactUs');
        $model->setName($data['replay_name']);
        $model->setEmail($data['replay_email']);
        $model->setComment($data['replay_comment']);
        $model->save();
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
