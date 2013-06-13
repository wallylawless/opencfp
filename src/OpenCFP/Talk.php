<?php

namespace OpenCFP;

class Talk {
	protected $_id;
	protected $_speaker;
	protected $_title;
	protected $_description;

	public function __construct()
	{
		// Nothing to do here yet
	}



	public function speaker()
	{
		return $this->_speaker;
	}

	public function title()
	{
		return $this->_title;
	}

	public function description()
	{
		return $this->_description;
	}

	public function setTitle($prmTitle)
	{
		$this->_title = $prmTitle;
	}

	public function setDescription($prmDescription)
	{
		$this->_description = $prmDescription;
	}

	public function setSpeaker(\OpenCFP\Speaker $prmSpeaker)
	{
		$this->_speaker = $prmSpeaker;
	}


}