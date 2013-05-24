 <form action="" method="post" enctype="multipart/form-data">
           <p>
		   <label for="id" >Id:<input type="text" name="id" value="<?php echo $_GET['id'] ?>">
           <input type="file" name="imagen">
           <input type="submit" name="submit" value="Subir" /></p>
        </form>
        <?php
        if(isset($_FILES['imagen'])){
        //configuracion
           $permitidas = array('jpg','jpeg','png','gif'); //extensiones permitidas
           $size=2097152; //tamano maximo en bytes
		
           $url="http://localhost/tiendesita/assets/img/".$carpeta; //con / al final
           $carpeta=$_POST['id']; //carpeta de las imagenes
 
           $errores = array();
           $nombre = trim($_FILES['imagen']['name']);
           $ext = strtolower(end(explode('.',$nombre)));
           $tamano = $_FILES['imagen']['size'];
           $tmp = $_FILES['imagen']['tmp_name'];
           $urlimagen=$carpeta."/".$nombre;
 
           if(in_array($ext,$permitidas) === false){
              $errores[] = 'Extension no permitida';
           }
           if($tamano>$size){
              $errores[] = 'El tamaño del archivo debe ser menor a 2mb';
           }
           if(empty($errores)){
              if(move_uploaded_file($tmp,$urlimagen)){
                 ?>
                 <h3>html</h3>
                 <input type="text" value="<img src='<?php echo $url.$urlimagen ?>'>" /><br />
                 <h3>BBcode</h3>
                 <input type="text" value="[img]<?php echo $url.$urlimagen ?>[/img]" /><br />
                 <h3>Enlace directo</h3>
                 <input type="text" value="<?php echo $url.$urlimagen ?>" /><br />
                 <?php
              }
           }else{
              foreach($errores as $error){
                 echo $error."<br />";
              }
           }
        }
        ?>