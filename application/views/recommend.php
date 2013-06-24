<?php echo form_open("software/recomendar/".$software, 'data-ajax=false');?>
<?php echo validation_errors()?>      
<p>
            <?php echo lang('sesel_name', 'name');?> <br />
            <?php echo form_input('name', set_value('name'));?>
      </p>

      <p>
            <?php echo lang('sesel_details', 'details');?> <br />
            <?php echo form_textarea('details',set_value('details'));?>
      </p>
      <p>
            <?php echo lang('sesel_groups', 'group');?> <br />
            <?php echo form_dropdown('group',$grupos);?>
      </p>
      <p><?php echo form_submit('submit', lang('sesel_recommend'));?></p>

    <?php echo form_hidden('software',$software);?>
<?php echo form_close();?>
