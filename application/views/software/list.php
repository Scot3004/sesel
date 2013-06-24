<div data-role="content">
    <ul data-role="listview" data-inset="true" data-theme="c" data-autodividers="true" data-dividertheme="a" data-filter="true" data-filter-placeholder="Filtrar Software">
        <?php if (empty($programas)): ?>
            <li data-role="list-divider" data-theme="c"><?php echo $this->lang->line('sesel_software_not_found');?></li>
            <?php
        else:
            if(!isset($link))
                $link='software/detalle/';
            foreach ($programas as $row):
                echo '<li>'.anchor($link.$row->idSoftware, 
                    "<h1>".$row->name."</h1>
                    <p>".$row->short_description."<br/>".$row->developer."</p>
                    ").'</li>';
            endforeach;
        endif;
        ?>
    </ul>
</div>
