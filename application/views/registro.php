    <script src="<?php echo base_url(); ?>/assets/js/tienda.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/jquery.mobile.datebox.min.css">
    <script type='text/javascript' src="<?php echo base_url(); ?>/assets/js/datebox.js"></script>
    <script type='text/javascript'>//<![CDATA[ 
        $(window).load(function(){
            $('#fechanac').live('click', function() {
                    $('#fechanac').datebox('open');
            });
        });//]]>  
    </script>
    <?php echo form_open('usuario/registro');?>
	<label for="identificacion">Documento Identidad *</label>
	<input name="identificacion" id="identificacion" placeholder="" value="" type="text" required/>

	<label for="nombres">Nombres *</label>
	<input name="nombres" id="nombre" placeholder="" value="" type="text" required/>
	
	<label for="apellidos">Apellidos *</label>
	<input name="apellidos" id="apellido" placeholder="" value="" type="text" required/>

	<label for="direccion">Direccion *</label>
	<input name="direccion" id="direccion" placeholder="" value="" type="text" required/>
	
	<label for="telefono">Telefono</label>
	<input name="telefono" id="telefono" placeholder="" value="" type="number" />
	
	<label for="email">Email *</label>
	<input name="email" id="email" placeholder="" value="" type="email" required />

	<label for="sexo">Genero</label>
	<select id="sexo" name="sexo" data-native-menu="false" data-theme="b" data-mini="true" >
	<option value="femenino">Femenino</option>
	<option value="masculino">Masculino</option>
	</select>	
	<label for="fechanac">Fecha de Nacimiento *</label>
	<input name="fechanac" id="fechanac" data-options='{"noButton": true}' placeholder="" value="" type="text" data-mini="true" required/>
	<br/>
	<label for="nick">Nick *</label>
	<input name="nick" id="nick" placeholder="" value="" type="text" required />

	<label for="clave">Clave *</label>
	<input name="clave" id="" placeholder="" value="" type="password" required/>

	<label for="rclave">Repetir Clave *</label>
	<input name="rclave" id="" placeholder="" value="" type="password" required/>

	<input data-theme="b" data-icon="forward" data-iconpos="left" value="Registrar" data-mini="true" type="submit" name="registrar"/>
  <?php echo form_close();?>