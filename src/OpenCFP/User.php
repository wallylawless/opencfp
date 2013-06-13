<?php

namespace OpenCFP;

class User
{
	protected $_id;
	protected $_name;

	public function __construct($id, $prmName=null)
	{
		if(isset($id)){
			$this->_id = $id;
		}

		if(isset($prmName)){
			$this->_name = $prmName;
		}
		return true;
	}

	public function id()
	{
		return $this->_id;
	}

	public function name()
	{
		return $this->_name;
	}
}