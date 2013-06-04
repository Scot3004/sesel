<?php
$class_vars = get_object_vars($objeto);
foreach ($class_vars as $name => $value) {
    if(is_object($value)){
        echo $name;
        ?>:
        <br/>
        <div style="margin-left: 20px">
            <?php $this->load->view('objeto', array('objeto' => $value)); ?>
        </div>
        <?php
    }else
        echo "$name : $value <br/>";       
}
?>
