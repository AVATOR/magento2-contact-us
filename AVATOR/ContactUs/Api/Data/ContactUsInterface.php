<?php

namespace AVATOR\ContactUs\Api\Data;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 *  Contact Us interface.
 *
 * @api
 * Interface ContactUsInterface
 * @package AVATOR\ContactUs\Api\Data
 */
interface ContactUsInterface
{
    /**
     * Get ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get short telephone.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set short telephone.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get telephone.
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Set telephone.
     *
     * @param string $telephone
     * @return $this
     */
    public function setTelephone($telephone);


    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment();

    /**
     * Set comment.
     *
     * @param string $comment
     * @return $this
     */
    public function setComment($comment);

    /**
     * Get record creation date.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set record creation date.
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

}