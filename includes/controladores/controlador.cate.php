<?php

/* This controller renders the category pages */

class CategoryController{
	public function handleRequest(){
		$cat = Category::find(array('id'=>$_GET['category']));
		
		if(empty($cat)){
			throw new Exception("No existen productos para esta categoria!");
		}
		
		// Fetch all the categories:
		$categories = Category::find();
		
		// Fetch all the products in this category:
		$products = Product::find(array('category'=>$_GET['category']));
		
		// $categories and $products are both arrays with objects
		
		render('category',array(
			'title'			=> $cat[0]->nombre,
			'categories'	=> $categories,
			'products'		=> $products
		));		
	}
}


?>
