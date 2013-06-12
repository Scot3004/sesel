<h1>No se pudo localizar la página</h1>
<?php printf($this->lang->line('sesel_page_not_found'), anchor(current_url()));
?>
<p><?php echo $this->lang->line('sesel_maybe');?></p>
<ul>
    <li><?php echo $this->lang->line('sesel_page_moved');?></li>
    <li><?php echo $this->lang->line('sesel_error_link');?></li>
</ul>
