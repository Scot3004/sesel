<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title>Sesel | <?php echo $titulo ?></title>
        <?php echo 
            link_tag('assets/css/jquery.css'),
            link_tag('assets/css/jquery.mobile.css'),
            link_tag('assets/css/styles.css');
        if(isset($css_files )){
            foreach ($css_files as $file): 
                echo link_tag('assets/css/'.$file);
            endforeach;
        }
        ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mobile.js"></script>
        <?php 
        if(isset($js_files )){
            foreach ($js_files as $file): 
                ?><script type="text/javascript" src="<?php echo base_url().('assets/js/'.$file); ?>"></script><?php
            endforeach;
        }    
         ?>
        
    </head>
    <body>
        <div data-role="page" data-theme="b">
            <div data-role="header" data-theme="b" data-position="fixed" >
                <a href="#" data-role="button" data-rel="back" data-icon="arrow-l"><?php echo lang('sesel_back') ?></a> 
                <h1>Sesel - <?php echo $titulo ?></h1>
                <a href="<?php echo site_url('main/menu/about')?>" data-icon="info" title="Help" class="ui-btn-right"><?php echo lang('sesel_project') ?></a>
            </div>
            <div data-role="navbar">
                <?php $this->load->view('menus/general');?>
            </div>
            <div data-role="content" data-theme="b" >
                <?php $this->load->view($view, $params); ?>
            </div>
            <div data-role="footer" data-theme="b" data-position="fixed"><h4><?php echo lang('sesel_footer');?></h4></div>
        </div>
    </body>
</html>
