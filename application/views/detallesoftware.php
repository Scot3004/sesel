<div class="rightColumn">
    <h1><?php echo $software->nombre; ?></h1>
    <p><?php echo $this->lang->line('sesel_developer');?> <?php echo $software->desarrollador; ?></p>
    <p><?php echo $this->lang->line('sesel_developer_url');?> <a href="<?php echo $software->url; ?>"><?php echo $software->url; ?></a></p>
    <p><?php echo $this->lang->line('sesel_location');?> <a href="<?php echo $software->ubicacion; ?>"><?php echo $software->ubicacion; ?></a></p>
    <p><?php echo $this->lang->line('sesel_description');?> <?php echo $software->descripcion; ?></p>
</div>
<div class="leftColumn">
    <a href="<?php echo base_url(); ?>programa/galeria/<?php echo $software->idSoftware ?>" data-ajax="false"><img title="<?php echo $software->nombre; ?>" class="imgsoft" src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $software->idSoftware ?>/cab.jpg" alt="<?php echo $software->nombre ?>" /></a>
</div>