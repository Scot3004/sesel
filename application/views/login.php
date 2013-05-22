<?php echo form_open('usuario/login');?>
    <?php echo validation_errors(); ?>
    <label for="nick">Nick  </label>
    <input name="nick" id="nick" placeholder="" value="" type="text" required> 
    <br/>
    <label for="clave">Clave</label>
    <input name="clave" id="" placeholder="" value="" type="password" required/>
    <input name="usuarios" id="usuarios" placeholder="" value="" type="hidden" />  
    <br/>
    <input data-theme="a" data-icon="forward" data-iconpos="right" value="Entrar" data-mini="true" type="submit" name="login"/>
<?php echo form_close();?>