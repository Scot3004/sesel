<?php
render('_header',array('title'=>$title))?>
<section class="leftColumn">
    <?php echo $fecha ?>
    <a href="./?usuarios=registro"  data-role="button" data-icon="check" data-ajax="false">Registrar Usuario</a>
    <a href="./?usuarios=buscar"  data-role="button" data-icon="check" data-ajax="false">Directorio de Usuarios</a>
    <a href="./?usuarios=salir"  data-role="button" data-icon="check" data-ajax="false">Cerrar Sesión</a>
    <a href="./?lista"  data-role="button" data-icon="grid" data-ajax="false" >Ver Software</a>
</section>
<section class="rightColumn">
    <?php render($content) ?>
</section>
<?php render('_footer')?>