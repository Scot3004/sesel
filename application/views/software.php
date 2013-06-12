<?php if (empty($categorias)): 
     echo $this->lang->line('sesel_empty');?>
<?php else: ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
            <?php foreach ($categorias as $categoria): ?>
                <li data-role="list-divider"><?php echo $categoria->nombre ?></li>
                <?php if (empty($categoria->programas)): ?>
                    <li data-role="list-divider" data-theme="c"><?php $this->lang->line('sesel_software_category_empty');?></li>
                <?php else:
                    foreach ($categoria->programas as $row):
                        ?>
                        <li><a href="<?php echo site_url('programa/detalle') ?>/<?php echo $row->idSoftware ?>"><h1><?php echo $row->nombre ?></h1><p><?php echo $row->resumen ?><br/><?php echo $row->desarrollador ?></p></a></li>
                    <?php endforeach;
                endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>