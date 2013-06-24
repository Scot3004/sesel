<div class="rightColumn">
    <h1><?php echo $software->name; ?></h1>
       <p><?php
        echo $this->lang->line('sesel_developer'),": ",
             $software->developer, "<br/>",
             $this->lang->line('sesel_url'),": ";
        echo anchor($software->url), "<br/>"; 
        echo $this->lang->line('sesel_location'),": "; 
        echo anchor($software->location), "<br/>";
        ?>
        <!--<div data-role="collapsible">
   <h3>Recomendar</h3>-->
   <?php
   echo form_open("software/recomendar/".$software->idSoftware, 'data-ajax=false'),
      /*'<p>',
           lang('sesel_name', 'name'),
           '<br />',
           form_input('name', set_value('name')),
      '</p>
       <p>',
           lang('sesel_details', 'details'),'<br />',
            form_textarea('details',set_value('details')),'</p>',
        */   
        form_hidden('software',$software->idSoftware),
        form_submit('submit', $this->lang->line('sesel_recommend')),
        form_close(),
        anchor('software/do_upload/'.$software->idSoftware, $this->lang->line('sesel_upload'),'data-role="button" data-icon="back" data-ajax="false"'),
//"</div>",
           $this->lang->line('sesel_description'),": ",
        $software->description 
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