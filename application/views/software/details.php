<div class="rightColumn">
    <h1><?php echo $software->name; ?></h1>
       <p><?php
        echo $this->lang->line('sesel_developer'),": ";
        echo $software->developer, "<br/>"; 
        echo $this->lang->line('sesel_url'),": ";
        echo anchor($software->url), "<br/>"; 
        echo $this->lang->line('sesel_location'),": "; 
        echo anchor($software->location), "<br/>";
        echo $this->lang->line('sesel_description'),": ";
        echo $software->description; 
        ?></p>
</div>
<div class="leftColumn">
    <?php 
    $image = array(
          'src' => "assets/uploads/files/".$software->idSoftware."/cab.jpg",
          'alt' => $software->short_description,
          'class' => 'imgsoft',
          'title' => $software->name,
          'rel' => 'lightbox',
);
    echo anchor("software/galeria/".$software->idSoftware, img($image), array('data-ajax'=>'false'))?>
    <!--<a href="<?php echo base_url(); ?>programa/galeria/<?php echo $software->idSoftware ?>" data-ajax="false"><img title="<?php echo $software->nombre; ?>" class="imgsoft" src="<?php echo base_url(); ?>assets/uploads/files/<?php echo $software->idSoftware ?>/cab.jpg" alt="<?php echo $software->nombre ?>" /></a>
-->
    </div>