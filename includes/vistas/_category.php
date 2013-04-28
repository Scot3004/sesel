<li <?php echo ($active == $category->id ? 'data-theme="a"' : '') ?>>
<a href="?category=<?php echo $category->id?>" data-transition="fade">
	<?php echo $category->nombre ?>
    <span class="ui-li-count"><?php echo $category->cuenta?></span></a>
</li>