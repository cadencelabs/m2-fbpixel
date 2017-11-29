<?php

namespace Cadence\Fbpixel\Observer;

use Magento\Framework\Event\ObserverInterface;

class CatalogControllerProductInitAfter implements ObserverInterface {

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
		/** @var Mage_Catalog_Model_Product $product */
		$product = $observer->getProduct();
		if (!$this->_fbPixelHelper->isViewProductPixelEnabled() || !$product) {
			return $this;
		}

		//verify if the product is an bundle product
		$contentType = 'product';
		if($product->getTypeId() == 'configurable'){
			$contentType = 'product_group';
		}

		$data = [
			'content_type' => $contentType,
			'content_ids' => [$product->getSku()],
			'value' => $product->getFinalPrice(),
			'currency' => $this->_fbPixelHelper->getCurrencyCode(),
			'content_name' => $product->getName()
		];

		$this->_fbPixelSession->setViewProduct($data);

		return $this;
	}
}
