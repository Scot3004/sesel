<?php
render('_header',array('title'=>$title))?>
<section class="leftColumn">
    <?php render($menu) ?>
</section>
<section class="rightColumn">
    <?php render($content) ?>
</section>
<?php render('_footer')?>