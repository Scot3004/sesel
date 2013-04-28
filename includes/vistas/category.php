<?php render('_header',array('title'=>$title))?>

<div class="rightColumn">
		
	<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="c" data-filter="true" data-filter-placeholder="Buscar <?php echo $title?>">
	
        <?php render($products) ?>
    </ul>
</div>

<div class="leftColumn">
    <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b" data-filter="true" data-filter-placeholder="Buscar Categorias">
        <li data-role="list-divider">Categorias</li>
        <?php render($categories,array('active'=>$_GET['category'])) ?>
    </ul>
</div>

<?php render('_footer')?>
