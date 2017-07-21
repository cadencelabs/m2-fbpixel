<?php

namespace Cadence\Fbpixel\Block;

use Magento\Framework\View\Element\Template;

class AbstractBlock
	extends \Magento\Framework\View\Element\Template
{
	/** @var \Cadence\Fbpixel\Helper\Data $_helper */
	protected $_helper;

	public function __construct(
		\Cadence\Fbpixel\Helper\Data $helper,
		Template\Context $context,
		array $data = []
	) {
		$this->_helper = $helper;
		parent::__construct( $context, $data );
	}

	public function getHelper(){
		return $this->_helper;
	}

	public function getSession(){
		return $this->getHelper()->getSession();
	}

	public function getCurrencyCode(){
		return $this->getHelper()->getCurrencyCode();
	}
}