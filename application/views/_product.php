
<li class="product" >
	
<img src="assets/img/<?php echo $product->codigo ?>/cab.jpg" alt="<?php echo $product->nombre ?>" /><h3><?php echo $product->nombre ?></h3>
 	<form action="carrito/agregar.php" method="POST"><p><?php echo $product->marca?><input  type="text" name="cantidad"  placeholder="Cantidad">
    <input  type="submit" value="Comprar"></p><?php echo $product->resumen ?> <b>$<?php echo $product->precio?></b>
	<input type="hidden" name="id" value="<?php echo $product->codigo ?>">
	<input type="hidden" name="precio" value="<?php echo $product->precio ?>">
	<input type="hidden" name="producto" value="<?php echo $product->nombre ?>">

    </form>
</li>

