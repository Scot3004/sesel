<?php
render('_header',array('title'=>$software->nombre))?>

<div class="rightColumn"><?php 
echo $software->idSoftware;
echo "<br/>";
echo $software->nombre;
echo "<br/>";
echo $software->ubicacion;
echo "<br/>";
echo $software->desarrollador;
echo "<br/>";
echo $software->descripcion;?>
</div>
<div class="leftColumn">
	<img src="assets/img/<?php echo $software->idSoftware ?>/cab.jpg" alt="<?php echo $software->nombre ?>" />
	
<?php render('_footer');
?>
