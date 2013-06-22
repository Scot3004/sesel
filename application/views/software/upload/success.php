

<h3><?php $this->lang->line('sesel_upload_success')?></h3>
<?php echo $id ?>
<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('software/do_upload/'.$id, $this->lang->line('sesel_upload_another'), 'data-role="button" data-icon="check" data-theme="a"  data-ajax="false"'); ?></p>
<p><?php echo anchor('software/detalles/'.$id, $this->lang->line('sesel_software'), 'data-role="button" data-icon="check" data-theme="a"'); ?></p>
