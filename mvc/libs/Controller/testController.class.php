<?php
  /**
  * 
  */
  class testController
  {
  	
  	function show()
  	{
  		$testModel = M('test');
  		$date = $testModel->get();

  		$testView = V('test');
  		$testView->display($date);
  	}
  }

?>