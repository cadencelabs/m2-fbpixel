<?php

namespace Cadence\Fbpixel\Observer;

use Magento\Framework\Event\ObserverInterface;

class WishlistAddProduct implements ObserverInterface {

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
		/** @var \Magento\Catalog\Model\Product $product */
		$product = $observer->getProduct();
		if (!$this->_fbPixelHelper->isAddToWishlistPixelEnabled() || !$product) {
			return $this;
		}

		$data = [
			'content_type' => 'product',
			'content_ids' => [$product->getSku()],
			'value' => $product->getFinalPrice(),
			'currency' => $this->_fbPixelHelper->getCurrencyCode()
		];

		$this->_fbPixelSession->setAddToWishlist($data);

		return $this;
	}
}