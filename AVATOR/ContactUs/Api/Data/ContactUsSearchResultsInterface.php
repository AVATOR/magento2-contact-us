<?php

namespace AVATOR\ContactUs\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Interface for cms page search results.
 *
 * @api
 * Interface ContactUsSearchResultsInterface
 * @package AVATOR\ContactUs\Api\Data
 */
interface ContactUsSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get pages list.
     *
     * @return \AVATOR\ContactUs\Api\Data\ContactUsInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \AVATOR\ContactUs\Api\Data\ContactUsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}