<?php
render('_header',array('title'=>$title))?>
<section class="leftColumn">
    <?php echo $fecha ?>
    <a href="./?usuarios=registro"  data-role="button" data-icon="check" data-ajax="false">Registrar Usuario</a>
    <a href="./?usuarios=salir"  data-role="button" data-icon="check" data-ajax="false">Cerrar Sesión</a>
    <a href="./?software"  data-role="button" data-icon="grid" data-ajax="false" >Ver Software</a>
</section>
<section class="rightColumn">
    <?php render($content) ?>
</section>
<?php render('_footer')?>