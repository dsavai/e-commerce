<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; 
  } 
}
?>


<div class="bg-white p-4 border-b border-gray-200">
    <div class="flex justify-center w-full overflow-x-auto md:overflow-hidden">
        <ul class="flex space-x-4 text-[#333b2c] md:text-base">
            <li><a class="<?php active('index.php');?>  hover:text-[#947040] hover:underline" href="index.php">Home</a></li>
            <li><a class="<?php active('clothing.php');?>  hover:text-[#947040] hover:underline" href="clothing.php">Clothing</a></li>
            <li><a class="<?php active('footwear.php');?>  hover:text-[#947040] hover:underline" href="footwear.php">Footwear</a></li>
            <li><a class="<?php active('grooming.php');?>  hover:text-[#947040] hover:underline" href="grooming.php">Grooming</a></li>
            <li><a class="<?php active('accessories.php');?>  hover:text-[#947040] hover:underline" href="accessories.php">Accessories</a></li>
        </ul>
    </div>
</div>