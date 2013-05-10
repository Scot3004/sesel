<?php

class HomeController{
    public function handleRequest(){
        if(isset($_SESSION['tipo'])){
            render('home',array(
                'title'	=> 'Bienvenido a SESEL',
                'menu'      => "menuadmin",
                'content'	=> "info"
            )); 
        }
         render('home',array(
                'title'	=> 'Bienvenido a SESEL',
                'menu'      => "menuinvitado",
                'content'	=> "info"        
            )); 
    }
}
