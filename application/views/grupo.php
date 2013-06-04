<div data-role="content">
    <ul data-role="listview" data-inset="true" data-theme="c" data-autodividers="true" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
        <?php if (empty($grupos)): ?>
            <li data-role="list-divider" data-theme="c">No hay Grupos</li>
            <?php
        else:
            foreach ($grupos as $row):
               ?>
                <li><a href="<?php echo site_url('grupo/detalle') ?>/<?php echo $row->idGrupo ?>">
                        <h1><?php echo $row->nombre ?></h1><p><?php echo $row->nivelAcademico ?><br/>
                            </p>
                    </a></li>
            <?php
            endforeach;
        endif;
        ?>
    </ul>
</div>
