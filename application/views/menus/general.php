<ul>
<?php
if($user!==null)
echo '<li>'.anchor('grupo', $this->lang->line('sesel_groups'), ' data-icon="grid" ').'</li>';
echo '<li>'.anchor('software', $this->lang->line('sesel_software'), 'data-icon="gear"').'</li>
      <li>'.anchor('main/menu/user', $this->lang->line('sesel_user'), 'data-icon="home"').'</li>';
if($admin)
echo '<li>'.anchor('admin', $this->lang->line('sesel_admin'), 'data-icon="back" data-ajax="false"').'</li>';
?></ul>