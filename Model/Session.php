<?php

namespace Cadence\Fbpixel\Model;

class Session extends \Magento\Framework\Session\SessionManager
{
	/**
	 * @var array
	 */
	protected $_ephemeralData = [];

	/**
	 * @param $data
	 * @return $this
	 */
	public function setAddToCart($data)
	{
		$this->setData('add_to_cart', $data);
		return $this;
	}

	/**
	 * @return mixed|null
	 */
	public function getAddToCart()
	{
		if ($this->hasAddToCart()) {
			$data = $this->getData('add_to_cart');
			$this->unsetData('add_to_cart');
			return $data;
		}
		return null;
	}

	/**
	 * @return bool
	 */
	public function hasAddToCart()
	{
		return $this->hasData('add_to_cart');
	}

	/**
	 * @param $data
	 * @return $this
	 */
	public function setAddToWishlist($data)
	{
		$this->setData('add_to_wishlist', $data);
		return $this;
	}

	/**
	 * @return mixed|null
	 */
	public function getAddToWishlist()
	{
		if ($this->hasAddToWishlist()) {
			$data = $this->getData('add_to_wishlist');
			$this->unsetData('add_to_wishlist');
			return $data;
		}
		return null;
	}

	/**
	 * @return bool
	 */
	public function hasAddToWishlist()
	{
		return $this->hasData('add_to_wishlist');
	}

	/**
	 * @return bool
	 */
	public function hasInitiateCheckout()
	{
		$has = $this->hasData('initiate_checkout');
		if ($has) {
			$this->unsetData('initiate_checkout');
		}
		return $has;
	}

	/**
	 * @return $this
	 */
	public function setInitiateCheckout()
	{
		$this->setData('initiate_checkout', true);
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasViewProduct()
	{
		return $this->_hasEphemeral('view_product');
	}

	/**
	 * @return mixed|null
	 */
	public function getViewProduct()
	{
		if ($this->hasViewProduct()) {
			$data = $this->_getEphemeral('view_product');
			$this->_unsetEphemeral('view_product');
			return $data;
		}
		return null;
	}

	/**
	 * @param $data
	 * @return $this
	 */
	public function setViewProduct($data)
	{
		$this->_setEphemeral('view_product', $data);
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasSearch()
	{
		return $this->_hasEphemeral('search');
	}

	/**
	 * @return mixed|null
	 */
	public function getSearch()
	{
		if ($this->hasSearch()) {
			$data = $this->_getEphemeral('search');
			$this->_unsetEphemeral('search');
			return $data;
		}
		return null;
	}

	/**
	 * @param $value
	 * @return $this
	 */
	public function setSearch($value)
	{
		$this->_setEphemeral('search', $value);
		return $this;
	}

	/**
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	protected function _setEphemeral($key, $value)
	{
		$this->_ephemeralData[$key] = $value;
		return $this;
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	protected function _getEphemeral($key)
	{
		return isset($this->_ephemeralData[$key])
			? $this->_ephemeralData[$key]
			: null;
	}

	/**
	 * @param $key
	 * @return bool
	 */
	protected function _hasEphemeral($key)
	{
		return isset($this->_ephemeralData[$key]);
	}

	/**
	 * @param $key
	 * @return $this
	 */
	protected function _unsetEphemeral($key)
	{
		unset($this->_ephemeralData[$key]);
		return $this;
	}
}