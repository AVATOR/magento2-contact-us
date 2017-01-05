<?php

namespace AVATOR\ContactUs\Plugin\Contact;

use Magento\Framework\App\Request\Http;
use Magento\Framework\ObjectManagerInterface;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Class Post
 * @package AVATOR\ContactUs\Plugin\Contact
 */
class Post
{
    /**
     * @var Http
     */
    protected $request;

    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Post constructor.
     * @param Http $request
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        Http $request,
        ObjectManagerInterface $objectManager
    ) {
        $this->request = $request;
        $this->objectManager = $objectManager;
    }

    /**
     * Save data to database
     */
    public function afterExecute()
    {
        $post = $this->request->getPostValue();
        if (!$post) {
            return;
        }

        $model = $this->objectManager->create('AVATOR\ContactUs\Model\ContactUs');
        $model->setName($post['name']);
        $model->setEmail($post['email']);
        $model->setTelephone($post['telephone']);
        $model->setComment($post['comment']);
        $model->save();
    }
}
