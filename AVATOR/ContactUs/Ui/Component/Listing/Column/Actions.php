<?php
namespace AVATOR\ContactUs\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * @category    AVATOR
 * @package     AVATOR_ContactUs
 * @author      Oleksii Golub oleksii.v.golub@gmail.com
 * @copyright   Copyright (c) 2017
 */

/**
 * Class Actions
 * @package AVATOR\ContactUs\Ui\Component\Listing\Column
 */
class Actions extends Column
{
    /** Url path */
    const CONTACT_URL_PATH_REPLAY = 'contact/contact/edit';

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $replayUrl;

    /**
     * Actions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $replayUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $replayUrl = self::CONTACT_URL_PATH_REPLAY
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->replayUrl = $replayUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->replayUrl, ['id' => $item['id']]),
                        'label' => __('Edit')
                    ];
                }
            }
        }

        return $dataSource;
    }
}
