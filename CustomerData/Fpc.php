<?php

namespace Cadence\Fbpixel\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Helper\Session\CurrentCustomer;

class Fpc implements SectionSourceInterface
{
    /** @var \Cadence\Fbpixel\Helper\Data $_helper */
    protected $_helper;

    /** @var \Magento\Framework\Url\Helper\Data $_urlHelper */
    protected $_urlBuilder;

    protected $_customerSession;

    protected $_currentCustomer;

    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \Cadence\Fbpixel\Helper\Data $helper,
        CurrentCustomer $currentCustomer
    ) {
        $this->_urlBuilder = $urlBuilder;
        $this->_customerSession = $customerSession;
        $this->_helper = $helper;
        $this->_currentCustomer = $currentCustomer;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getSectionData() {

        $data = [
            'events' => []
        ];

        if ($this->_helper->getSession()->hasAddToCart()) {
            // Get the add-to-cart information since it's unique to the user
            // but might be displayed on a cached page
            $data['events'][] = [
                'eventName' => 'AddToCart',
                'eventAdditional' => $this->_helper->getSession()->getAddToCart()
            ];
        }
        return $data;
    }
}