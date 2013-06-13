<?php

namespace OpenCFP;

class Speaker
{
	protected $_id;
	protected $_name;

	public function __construct($prmSpeakerName)
	{
		if(isset($prmSpeakerName)){
			$this->_name = $prmSpeakerName;
		}
		return true;
	}

	public function name()
	{
		return $this->_name;
	}
}