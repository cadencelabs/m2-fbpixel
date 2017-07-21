<?php

namespace Cadence\Fbpixel\Observer;

use Magento\Framework\Event\ObserverInterface;

class SalesQuoteProductAddAfter implements ObserverInterface {

	/** @var \Cadence\Fbpixel\Model\Session $_fbPixelSession */
	protected $_fbPixelSession;
	/** @var \Magento\Checkout\Model\Session $_checkoutSession */
	protected $_checkoutSession;
	/** @var  \Cadence\Fbpixel\Helper\Data $_fbPixelHelper */
	protected $_fbPixelHelper;

	public function __construct(
		\Cadence\Fbpixel\Model\Session $fbPixelSession,
		\Magento\Checkout\Model\Session $checkoutSession,
		\Cadence\Fbpixel\Helper\Data $helper
	) {
		$this->_fbPixelSession = $fbPixelSession;
		$this->_checkoutSession = $checkoutSession;
		$this->_fbPixelHelper         = $helper;
	}

	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 *
	 * @return void
	 */
	public function execute( \Magento\Framework\Event\Observer $observer ) {
		if(!$this->_fbPixelHelper->isAddToCartPixelEnabled()){
			return $this;
		}
		$items = $observer->getItems();
		$candidates = array_replace([
			'content_ids' => [],
			'value' => 0.00
		], $this->_fbPixelSession->getAddToCart() ?: array());

		/** @var \Magento\Sales\Model\Order\Item $item */
		foreach ($items as $item) {
			if ($item->getParentItem()) {
				continue;
			}
			$candidates['content_ids'][] = $item->getSku();
			$candidates['value'] += $item->getProduct()->getFinalPrice() * $item->getProduct()->getQty();
		}

		$data = array(
			'content_type' => 'product',
			'content_ids' => $candidates['content_ids'],
			'value' => $candidates['value'],
			'currency' => $this->_fbPixelHelper->getCurrencyCode()
		);

		$this->_fbPixelSession->setAddToCart($data);

		return $this;
	}
}