<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	
	<title>{page_title}</title>
	
	    
        <link rel="stylesheet" href="http://127.0.0.1/sesel/assets/css/jquery.mobile-1.3.1.min.css" />
    <link rel="stylesheet" href="http://127.0.0.1/sesel/assets/css/styles.css" />
    <script type="text/javascript" src="http://127.0.0.1/sesel/assets/js/jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="http://127.0.0.1/sesel/assets/js/jquery.mobile-1.3.1.min.js"></script> 
</head>

<body>

<div data-role="page" data-theme="{global_theme}">

	{header}
	
	{navbar}
	
	<div data-role="content" data-theme="{global_theme}">
	
		<?php $this->load->view($view); ?>
		
	</div>
		
	{footer}
	
</div>

</body>
</html>
