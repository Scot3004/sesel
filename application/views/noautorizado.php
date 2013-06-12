<h1>No estás autorizado para acceder a la página</h1>
<?php printf($this->lang->line('sesel_page_not_authorized'), anchor(current_url()));
?>
<a href="<?php echo site_url('auth/login')?>" data-role="button" data-icon="check" data-theme="a"><?php echo $this->lang->line('sesel_login');?></a>
<a href="<?php echo site_url('usuario/registro')?>" data-role="button" data-icon="check" data-theme="a"><?php echo $this->lang->line('sesel_register');?></a>
