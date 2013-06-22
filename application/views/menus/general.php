<ul><li>
<?php
echo anchor('grupo', $this->lang->line('sesel_groups'), ' data-icon="grid" ');
?></li><li><?php
echo anchor('software', $this->lang->line('sesel_software'), 'data-icon="gear"');
?></li><li><?php
echo anchor('main/menu/user', $this->lang->line('sesel_users'), 'data-icon="home"');
?></li><li><?php
echo anchor('admin', $this->lang->line('sesel_admin'), 'data-icon="back" data-ajax="false"');
?></li></ul>