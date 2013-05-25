<div class="rightColumn">
    <h1><?php echo $software->nombre; ?></h1>
    <p>Desarrollador: <?php echo $software->desarrollador; ?></p>
    <p>URL Desarrollador: <a href="<?php echo $software->url; ?>"><?php echo $software->url; ?></a></p>
    <p>Ubicacion: <a href="<?php echo $software->ubicacion; ?>"><?php echo $software->ubicacion; ?></a></p>
    <p>Descripcion: <?php echo $software->descripcion; ?></p>
</div>
<div class="leftColumn">
    <img src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $software->idSoftware ?>/cab.jpg" alt="<?php echo $software->nombre ?>" />
