<?php
namespace AVATOR\ContactUs\Block\Adminhtml\Contact\Edit;

/**
 * Adminhtml contactus edit form
 *
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;

/**
 * Class Form
 * @package AVATOR\ContactUs\Block\Adminhtml\Contact\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('contactus_form');
        $this->setTitle(__('ContactUs Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \AVATOR\ContactUs\Model\ContactUs $model */
        $model = $this->_coreRegistry->registry('contact');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('contactus_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'readonly' => true, 'label' => __('Name'), 'title' => __('Name'), 'required' => true]
        );

        $fieldset->addField(
            'email',
            'text',
            ['name' => 'email', 'readonly' => true, 'label' => __('Email'), 'title' => __('Email'), 'required' => true]
        );

        $fieldset->addField(
            'telephone',
            'text',
            ['name' => 'telephone', 'readonly' => true, 'label' => __('Telephone'), 'title' => __('Telephone'), 'required' => true]
        );

        $fieldset->addField(
            'comment',
            'editor',
            [
                'name' => 'comment',
                'label' => __('Comment'),
                'title' => __('Comment'),
                'style' => 'height:18em',
                'required' => true,
                'readonly' => true,
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['1' => __('Answer'), '0' => __('No answer')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', '1');
        }

        $fieldset->addField(
            'replay_name',
            'text',
            ['name' => 'replay_name', 'label' => __('Answer Name'), 'title' => __('Answer Name'), 'required' => true]
        );

        $fieldset->addField(
            'replay_email',
            'text',
            ['name' => 'replay_email', 'label' => __('Answer Email'), 'title' => __('Answer Email'), 'required' => true]
        );

        $fieldset->addField(
            'replay_comment',
            'editor',
            [
                'name' => 'replay_comment',
                'label' => __('Answer Comment'),
                'title' => __('Answer Comment'),
                'style' => 'height:18em',
                'required' => true,
            ]
        );


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
