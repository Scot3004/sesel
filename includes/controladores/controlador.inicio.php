<?php

class HomeController{
    public function handleRequest(){
        render('home',array(
            'title'	=> 'Bienvenido',
            'content'	=> "info",
            'fecha'     => $sfevento
        ));
    }
}
