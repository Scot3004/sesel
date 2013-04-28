<?php

class HomeController{
	public function handleRequest(){
		
		// Select all the categories:
		$content = "info";
		
		render('home',array(
			'title'		=> 'Bienvenido',
			'content'	=> $content,
			'fecha'     => $sfevento
		));
	}
}

?>
