<?php
$class_vars = get_object_vars($objeto);
foreach ($class_vars as $name => $value) {
    echo "$name : $value <br/>";
}
?>
