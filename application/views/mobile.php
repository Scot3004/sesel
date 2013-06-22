<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Sesel | <?php echo $titulo ?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.mobile-1.3.1.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ditocss/idangerous.swiper.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.0.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mobile-1.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ditojs/idangerous.swiper.js"></script>

    </head>
    <body>
        <div data-role="page" data-theme="b">
            <div data-role="header" data-theme="b" data-position="fixed" >
                <a href="#" data-role="button" data-rel="back" data-icon="arrow-l">Atras</a> 
                <h1>Sesel - <?php echo $titulo ?></h1>
                <a href="<?php echo site_url('main')?>" data-icon="info" title="Help" class="ui-btn-right">Proyecto</a>
            </div>
            <div data-role="navbar">
                <?php $this->load->view('menus/general');?>
            </div>
            <div data-role="content" data-theme="b" >
                <?php $this->load->view($view, $params); ?>
            </div>
            <div data-role="footer" data-theme="b" data-position="fixed"><h4><?php echo $this->lang->line('sesel_footer');?></h4></div>
        </div>
    </body>
</html>
