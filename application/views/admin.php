<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/elementos.css" />
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <style type='text/css'>
            body
            {
                font-family: Arial;
                font-size: 14px;
            }
            a {
                color: blue;
                text-decoration: none;
                font-size: 14px;
            }
            a:hover
            {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <nav>    
            <?php
            echo anchor(site_url('main'), $this->lang->line('sesel_start'));
            echo anchor(site_url('admin/software'), $this->lang->line('sesel_software'));
            echo anchor(site_url('admin/asignatura'), $this->lang->line('sesel_subject'));
            echo anchor(site_url('admin/recomendacion'), $this->lang->line('sesel_recomendation'));
            echo anchor(site_url('admin/usuario'), $this->lang->line('sesel_user'));
            //echo anchor(site_url('admin/estudiante'), $this->lang->line('sesel_student'));
            echo anchor(site_url('admin/docente'), $this->lang->line('sesel_teacher'));
            echo anchor(site_url('admin/grupo'), $this->lang->line('sesel_groups'));
            echo anchor(site_url('auth/logout'), $this->lang->line('sesel_logout'));
        ?>            
        </nav>
        <div style='height:20px;'></div>  
        <div>
            <?php echo $output; ?>
        </div>
    </body>
</html>
