<?php
echo anchor('grupo/listar', $this->lang->line('sesel_groups_list'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('grupo/asignatura', $this->lang->line('sesel_groups_list_subject'), 'data-role="button" data-icon="check" data-theme="a"');
if($user!==null)
    echo anchor('grupo/docente', $this->lang->line('sesel_groups_list_teacher'), 'data-role="button" data-icon="check" data-theme="a"');
if($teacher>0)
    echo anchor('software/docente/'.$user->id, $this->lang->line('sesel_my_groups'), 'data-role="button" data-icon="check" data-theme="a"');