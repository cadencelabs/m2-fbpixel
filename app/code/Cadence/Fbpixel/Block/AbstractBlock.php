<?php

namespace Cadence\Fbpixel\Block;

use Magento\Framework\View\Element\Template;
use Cadence\Fbpixel\Model\Session as FbpixelSession;

class AbstractBlock
	extends \Magento\Framework\View\Element\Template
{
	/** @var \Cadence\Fbpixel\Helper\Data $_helper */
	protected $_helper;
	/** @var \Cadence\Fbpixel\Model\Session $_session */
	protected $_session;

	public function __construct(
		\Cadence\Fbpixel\Helper\Data $helper,
		Template\Context $context,
		FbpixelSession $session,
		array $data = []
	) {
		$this->_helper = $helper;
		$this->_session = $session;
		parent::__construct( $context, $data );
	}

	public function getHelper(){
		return $this->_helper;
	}

	public function getSession(){
		return $this->_session;
	}

	public function getCurrencyCode(){
		return $this->getHelper()->getCurrencyCode();
	}
}