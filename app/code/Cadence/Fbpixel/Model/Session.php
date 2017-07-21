<?php

namespace Cadence\Fbpixel\Model;

class Session extends \Magento\Framework\Session\SessionManager
{
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
		return $this->hasData('view_product');
	}

	/**
	 * @return mixed|null
	 */
	public function getViewProduct()
	{
		if ($this->hasViewProduct()) {
			$data = $this->getData('view_product');
			$this->unsetData('view_product');
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
		$this->setData('view_product', $data);
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasSearch()
	{
		return $this->hasData('search');
	}

	/**
	 * @return mixed|null
	 */
	public function getSearch()
	{
		if ($this->hasSearch()) {
			$data = $this->getData('search');
			$this->unsetData('search');
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
		$this->setData('search', $value);
		return $this;
	}

}