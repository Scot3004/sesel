<?php if (empty($categorias)): 
     echo $this->lang->line('sesel_empty');?>
<?php else: ?>
    <div data-role="content">
        <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
            <?php foreach ($categorias as $categoria): ?>
            <li data-role="list-divider"><?php echo $categoria->name ?></li>
                <?php if (empty($categoria->grupos)): ?>
            <li data-role="list-divider" data-theme="c"><?php echo $this->lang->line('sesel_groups_not_found');?></li>
            <?php
        else:
            foreach ($categoria->grupos as $row):
                echo '<li>'.anchor('grupo/detalle/'.$row->id, 
                    "<h1>".$row->name."</h1>
                    <p>".$row->level."<br/>".$row->teacher."<br/>".$row->subject."</p>
                    ").'</li>';
            endforeach;
        endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>