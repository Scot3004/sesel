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
            <a href='<?php echo site_url('admin/programa') ?>' >Software</a> 	
            <a href='<?php echo site_url('admin/asignatura') ?>' >Asignatura</a> 
            <a href='<?php echo site_url('admin/recomendacion') ?>' >Recomendaciones</a> 
            <a href='<?php echo site_url('admin/usuario') ?>' >Usuarios</a> 
            <a href='<?php echo site_url('admin/estudiante') ?>' >Estudiante</a> 
            <a href='<?php echo site_url('admin/docente') ?>' >Docente</a> 
            <a href='<?php echo site_url('admin/grupo') ?>' >Grupos</a> 
            <a href='<?php echo site_url('usuario') ?>' >Perfil de Usuario</a> 
            <a href='<?php echo site_url('usuario/salir') ?>' >Salir</a>  
        </nav>
        <div style='height:20px;'></div>  
        <div>
            <?php echo $output; ?>
        </div>
    </body>
</html>
