<script type="text/javascript">
        /*======
        Use document ready or window load events
        For example:
        With jQuery: $(function() { ...code here... })
        Or window.onload = function() { ...code here ...}
        Or document.addEventListener('DOMContentLoaded', function(){ ...code here... }, false)
        =======*/

        
        $(function(){
	var mySwiper = $('.swiper-container').swiper({
		//Your options here:
		mode:'horizontal',
		loop: true,
                keyboardControl: true,
                autoPlay: 5000
		//etc..
	});
        })
        </script> 
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



