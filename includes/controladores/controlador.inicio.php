<?php

class HomeController{
    public function handleRequest(){
        render('home',array(
            'title'	=> 'Bienvenido a SESEL',
            'content'	=> "info",
            'fecha'     => $sfevento
        ));
    }
}
