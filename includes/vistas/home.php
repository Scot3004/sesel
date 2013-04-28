<?php
render('_header',array('title'=>$title))?>
<p>Recuerda. Esta pagina se adapta a tu pantalla</p>
<section class="rightColumn">
        Bienvenido a continuación puedes localizar un software <?php echo $fecha ?>
		<a href="./?usuarios=registro"  data-role="button" data-icon="check" data-ajax="false">REGISTRARME</a>
		<a href="./?category"  data-role="button" data-icon="grid" data-ajax="false" >VER SOFTWARE</a>
		<?php /*'render(array('title'=>$title)) */?>
</section>
<section class="leftColumn">
    <?php render($content) ?>
</section>
<?php render('_footer')?>
