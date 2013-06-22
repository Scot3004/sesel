<?php
echo anchor('auth/change_password', $this->lang->line('sesel_change_password'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('auth/register', $this->lang->line('sesel_register'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('auth', $this->lang->line('sesel_user_admin'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('admin/usuario', $this->lang->line('sesel_user_admin'), 'data-role="button" data-icon="check" data-theme="a" data-ajax="false"');
echo anchor('auth/logout', $this->lang->line('sesel_logout'), 'data-role="button" data-icon="check" data-theme="a" data-ajax="false"');
