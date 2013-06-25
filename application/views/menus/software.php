<?php
echo anchor('software/listar', $this->lang->line('sesel_software_list'), 'data-role="button" data-icon="check" data-theme="a"'),
     anchor('software/asignatura', $this->lang->line('sesel_software_list_subject'), 'data-role="button" data-icon="check" data-theme="a"');
if($user!==null)     
    echo anchor('software/docente', $this->lang->line('sesel_software_list_teacher'), 'data-role="button" data-icon="check" data-theme="a"');
if($teacher>0)
    echo anchor('software/docente/'.$user->id, $this->lang->line('sesel_software_my_list'), 'data-role="button" data-icon="check" data-theme="a"');