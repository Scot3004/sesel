<?php

/* This controller renders the category pages */

class ControladorSoftware{
	public function handleRequest(){
		
		$software = Software::buscar(array('idSoftware'=>$_GET['software']));
		
		// $categories and $products are both arrays with objects
		
		render('software',array(
			'software'		=> $software[0]
		));		
	}
}


?>
