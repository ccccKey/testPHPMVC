<?php
  /**
  * 
  */
  class testController
  {
  	
  	function show()
  	{
  		$testModel = new M('test');
  		$date = $testModel->get();

  		$testView = new C('test');
  		$testView->display($date);
  	}
  }

?>