<div data-role="content">
    <ul data-role="listview" data-inset="true" data-theme="c" data-autodividers="true" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
        <?php if (empty($programas)): ?>
            <li data-role="list-divider" data-theme="c">No hay programas para esta categoria</li>
            <?php
        else:
            foreach ($programas as $row):
                ?>
                <li><a href="<?php echo site_url('programa/detalle') ?>/<?php echo $row->idSoftware ?>">
                        <h1><?php echo $row->nombre ?></h1><p><?php echo $row->resumen ?><br/>
                            <?php echo $row->desarrollador ?></p>
                    </a></li>
            <?php
            endforeach;
        endif;
        ?>
    </ul>
</div>
