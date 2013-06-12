<?php if (empty($categorias)): ?>
    No se encontraron datos
<?php else: ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
            <?php foreach ($categorias as $categoria): ?>
                <li data-role="list-divider"><?php echo $categoria->nombre ?></li>
                <?php if (empty($categoria->grupos)): ?>
                    <li data-role="list-divider" data-theme="c"><?php echo $this->lang->line('sesel_no_groups_category');?></li>
                <?php else:
                    foreach ($categoria->grupos as $row):
                       ?>
                        <li><a href="<?php echo site_url('grupo/detalle') ?>/<?php echo $row->idGrupo ?>">
                                <h1><?php echo $row->nombre ?></h1><p><?php echo $row->nivelAcademico ?><br/>
                                    </p>
                            </a></li>
                    <?php
                    endforeach;
                endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>