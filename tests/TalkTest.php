<?php
class TalkTest extends \PHPUnit_Framework_TestCase
{

	public function testSetters()
	{

		$talk = new \OpenCFP\Talk();

		$talk->setTitle("Test Title");
		$this->assertEquals("Test Title", $talk->title() , "Set title was not returned as title.");

		$talk->setDescription("Test Description");
		$this->assertEquals("Test Description", $talk->description() , "Set description was not returned as description.");		
	}


}