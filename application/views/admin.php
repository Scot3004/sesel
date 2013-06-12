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
            <a href='<?php echo site_url('main') ?>' class="ui-button-text">Inicio</a> 	
            <a href='<?php echo site_url('admin/programa') ?>' ><?php echo $this->lang->line('sesel_software');?></a> 	
            <a href='<?php echo site_url('admin/asignatura') ?>' ><?php echo $this->lang->line('sesel_signature');?></a> 
            <a href='<?php echo site_url('admin/recomendacion') ?>' ><?php echo $this->lang->line('sesel_recomendation');?></a> 
            <a href='<?php echo site_url('admin/usuario') ?>' ><?php echo $this->lang->line('sesel_user');?></a> 
            <a href='<?php echo site_url('admin/estudiante') ?>' ><?php echo $this->lang->line('sesel_student');?></a> 
            <a href='<?php echo site_url('admin/docente') ?>' ><?php echo $this->lang->line('sesel_teacher');?></a> 
            <a href='<?php echo site_url('admin/grupo') ?>' ><?php echo $this->lang->line('sesel_groups');?></a> 
            <a href='<?php echo site_url('usuario') ?>' ><?php echo $this->lang->line('sesel_user_profile');?></a> 
            <a href='<?php echo site_url('usuario/salir') ?>' ><?php echo $this->lang->line('sesel_logout');?></a>  
        </nav>
        <div style='height:20px;'></div>  
        <div>
            <?php echo $output; ?>
        </div>
    </body>
</html>
