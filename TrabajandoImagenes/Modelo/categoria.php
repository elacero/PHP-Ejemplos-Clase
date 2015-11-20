<?php
class categories
{
	public $CategoryID;
	public $CategoryName;
	public $Description;
	public $Picture;
	
	public function getClave()
	{
		return $this->CategoryID;
	}
}