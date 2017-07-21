<?php

namespace Cadence\Fbpixel\Observer;

use Magento\Framework\Event\ObserverInterface;

class Search implements ObserverInterface {

	/** @var \Cadence\Fbpixel\Model\Session $_fbPixelSession */
	protected $_fbPixelSession;
	/** @var \Magento\Checkout\Model\Session $_checkoutSession */
	protected $_checkoutSession;
	/** @var  \Cadence\Fbpixel\Helper\Data $_fbPixelHelper */
	protected $_fbPixelHelper;
	/** @var \Magento\Search\Helper\Data $_searchHelper */
	protected $_searchHelper;

	public function __construct(
		\Cadence\Fbpixel\Model\Session $fbPixelSession,
		\Magento\Checkout\Model\Session $checkoutSession,
		\Cadence\Fbpixel\Helper\Data $helper,
		\Magento\Search\Helper\Data $searchHelper
	) {
		$this->_fbPixelSession = $fbPixelSession;
		$this->_checkoutSession = $checkoutSession;
		$this->_fbPixelHelper         = $helper;
		$this->_searchHelper = $searchHelper;
	}

	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 *
	 * @return void
	 */
	public function execute( \Magento\Framework\Event\Observer $observer ) {
		$text = $this->_searchHelper->getEscapedQueryText();

		if (!$this->_fbPixelHelper->isSearchPixelEnabled() || !$text || !strlen($text)) {
			return $this;
		}

		$data = [
			'search_string' => $text
		];

		$this->_fbPixelSession->setSearch($data);

		return $this;
	}
}