<?php
echo anchor('grupo/listar', $this->lang->line('sesel_groups_list'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('grupo/asignatura', $this->lang->line('sesel_groups_list_subject'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('grupo/docente', $this->lang->line('sesel_groups_list_teacher'), 'data-role="button" data-icon="check" data-theme="a"');
if($docente!==null)
    echo anchor('software/docente/'.$docente, $this->lang->line('sesel_my_groups'), 'data-role="button" data-icon="check" data-theme="a"');