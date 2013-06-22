<div data-role="content">
    <ul data-role="listview" data-inset="true" data-theme="c" data-autodividers="true" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
        <?php if (empty($groups)): ?>
            <li data-role="list-divider" data-theme="c"><?php echo $this->lang->line('sesel_software_not_found');?></li>
            <?php
        else:
            foreach ($groups as $row):
                echo '<li>'.anchor('grupo/detalle/'.$row->id, 
                    "<h1>".$row->name."</h1>
                    <p>".$row->level."<br/>".$row->teacher."<br/>".$row->subject."</p>
                    ").'</li>';
            endforeach;
        endif;
        ?>
    </ul>
</div>
