<?php
echo anchor('software/listar', $this->lang->line('sesel_software_list'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('software/asignatura', $this->lang->line('sesel_software_list_subject'), 'data-role="button" data-icon="check" data-theme="a"');
echo anchor('software/docente', $this->lang->line('sesel_software_list_teacher'), 'data-role="button" data-icon="check" data-theme="a"');