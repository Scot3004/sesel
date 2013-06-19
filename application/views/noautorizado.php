<?php 
echo heading($this->lang->line('sesel_page_not_authorized'));
printf($this->lang->line('sesel_page_not_authorized_details'), anchor(current_url()));
echo anchor('auth/login', $this->lang->line('sesel_login'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('usuario/registro', $this->lang->line('sesel_register'), 'data-role="button" data-icon="check" data-theme="a"');