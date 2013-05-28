
  <ul id="Gallery" class="gallery">
<?php
/*

    $directory= '/assets/uploads/files/1/';//$software->idSoftware;
     
    $dirint = dir($directory);
    while (($archivo = $dirint->read()) !== false)
    {   
        if ($archivo != "." && $archivo != ".."){

        echo "<li><a href='".$directory."/".$archivo."' ><img height='250px' style='margin:5px auto;text-align:center' src='".$directory."/".$archivo."' alt='Imagen 1' ></a><li><br/>";
       
       }
    }
    $dirint->close();*/
 foreach($map as $archivo){
     echo "<li><a href='".base_url().$carpeta."/".$archivo."' ><img src='".base_url().$carpeta."/".$archivo."'/></a></li>";
 }
?>
</ul>

