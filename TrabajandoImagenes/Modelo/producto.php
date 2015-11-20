<?php
class products
{
	/**
	 * [key]
	 */
	public $ProductID;
	public $ProductName;
	public $SupplierID;
	public $CategoryID;
	public $QuantityPerUnit;
	public $UnitPrice;
	public $UnitsInStock;
	public $UnitsOnOrder;
	public $ReorderLevel;
	public $Discontinued;
	
	public function getUnitPrice()
	{
		return $this->UnitPrice;
	}
	
	public function setUnitPrice($precio)
	{
		$this->UnitPrice=$precio;
	}
	
	public function getClave()
	{
		return $this->ProductID;
	}
}