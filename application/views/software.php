<div data-role="content">
    <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a">
        <?php foreach ($array as $row): ?>
            <li data-role="list-divider">Software</li>
            <li><a href="<?php echo site_url('programa/detalle')?>/<?php echo $row->idSoftware ?>"><h1><?php echo $row->nombre ?></h1><p><?php echo $row->resumen ?><br/><?php echo $row->desarrollador ?></p></a></li>
        <?php endforeach; ?>
    </ul>
</div>	