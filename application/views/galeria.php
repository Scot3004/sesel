<div class="nomsnap"><?php echo $software->nombre; ?></div>  
<div class="swiper-container" >
    
    <div class="swiper-wrapper">
        <!--Slide-->
        
           <?php
           foreach($map as $archivo){
               echo "<div class='swiper-slide'>";
               echo "<img class='imgal' src='".base_url().$carpeta."/".$archivo."'/>";
               echo "</div>";
           }
          ?>
    </div>
      
  </div>   



