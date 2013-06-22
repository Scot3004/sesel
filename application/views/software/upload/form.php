
<?php echo $error;?>

<?php echo form_open_multipart('software/do_upload/'.$id, 'data-ajax="false"');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="<?php echo $this->lang->line('sesel_upload')?>" />

</form>
<p><?php echo anchor('software/detalles/'.$id, $this->lang->line('sesel_software'), 'data-role="button" data-icon="check" data-theme="a"'); ?></p>
