 <form action="" method="post" enctype="multipart/form-data">
           <p>
		   <label for="id" >Id:<input type="text" name="id" value="<?php echo (empty($_GET['id'])) ? '' : $_GET['id']; ?>">
           <input type="file" name="imagen">
           <input type="submit" name="submit" value="Subir" />
		   <input type="checkbox" name="cab" />Imagen Por Defecto<br>
		   
		   </p>
		   checkbox para que puedas dejar la imagen que va por defecto en mostrar productos
        </form>
        <?php
        if(isset($_FILES['imagen'])){
        //configuracion
           $permitidas = array('jpg','jpeg','png','gif'); //extensiones permitidas
           $size=2097152; //tamano maximo en bytes
           $carpeta=$_POST['id']; //carpeta de las imagenes
		   $url="http://localhost/tiendesita/assets/img/"; //con / al final
			if (!file_exists($carpeta)){
				mkdir($carpeta);				
			}
			
           $errores = array();
           $nombre = trim($_FILES['imagen']['name']);
		   $cab= $_POST['cab'];
		   if ($cab=="on"){
				$nombre="cab.jpg";				
			}
		   $sext=explode('.',$nombre);
           $ext = strtolower(end($sext));
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
                 <input type="text" value="<img src='<?php echo $url.$urlimagen ?>'>" readonly /><br />
                 <h3>Enlace directo</h3>
                 <input type="text" value="<?php echo $url.$urlimagen ?>" readonly /><br />
                 <?php
              }
           }else{
              foreach($errores as $error){
                 echo $error."<br />";
              }
           }
        }
        ?>