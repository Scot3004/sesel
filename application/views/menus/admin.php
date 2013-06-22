<?php
echo anchor(site_url('main'), $this->lang->line('sesel_start'));
echo anchor(site_url('admin/software'), $this->lang->line('sesel_software'));
echo anchor(site_url('admin/asignatura'), $this->lang->line('sesel_subject'));
echo anchor(site_url('admin/recomendacion'), $this->lang->line('sesel_recomendation'));
echo anchor(site_url('admin/usuario'), $this->lang->line('sesel_user'));
//echo anchor(site_url('admin/estudiante'), $this->lang->line('sesel_student'));
//echo anchor(site_url('admin/docente'), $this->lang->line('sesel_teacher'));
echo anchor(site_url('admin/grupo'), $this->lang->line('sesel_groups'));
echo anchor(site_url('auth/logout'), $this->lang->line('sesel_logout'));
        