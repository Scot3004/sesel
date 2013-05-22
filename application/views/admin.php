<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
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
            <a href='<?php echo site_url('admin/software_management')?>' >Software</a> 	
            <a href='<?php echo site_url('admin/subject_management')?>' >Asignatura</a> 
            <a href='<?php echo site_url('admin/user_management')?>' >Usuarios</a> 
            <a href='<?php echo site_url('admin/master_management')?>' >Docente</a> 
            <a href='<?php echo site_url('admin/recomend_management')?>' >Recomendaciones</a> 
            <a href='<?php echo site_url('admin/group_management')?>' >Grupos</a> 
	</nav>
	<div style='height:20px;'></div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
