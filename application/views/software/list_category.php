<?php if (empty($categorias)): 
     echo $this->lang->line('sesel_empty');?>
<?php else: ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
            <?php foreach ($categorias as $categoria): ?>
                <li data-role="list-divider"><?php echo $categoria->name ?></li>
                <?php if (empty($categoria->programas)): ?>
                    <li data-role="list-divider" data-theme="c"><?php echo $this->lang->line('sesel_software_not_found');?></li>
                <?php else:
                    foreach ($categoria->programas as $row):
                        echo '<li>'.anchor('software/detalle/'.$row->idSoftware, 
                            "<h1>".$row->name."</h1>
                            <p>".$row->short_description."<br/>".$row->developer."</p>
                            ").'</li>';
                    endforeach;
                endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>