<?php
$uri = $_SERVER['REQUEST_URI'];
//echo $uri; // Outputs: URI
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 // Outputs: Full URL
 
//$query = $_SERVER['QUERY_STRING'];
//echo $query; // Outputs: Query String
?>
<!--Facebook button-->
<a target="_blank" class="fa fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>"  data-layout="button" data-href="<?php echo $url;?>" ></a>
 <!--Twitter button-->
<a target="_blank" class="fa fa-twitter" href="https://twitter.com/share?url=<?php echo $url;?>&amp;via=developerspotKE&amp;text=<?php echo $posts['post_title'] ?>&amp;hashtags=webdevelopment,webdesign" >
</a>
<!--Linkedin button-->
<span><a target="_blank" class="fa fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $url;?>&title=<?php echo $posts['post_title'] ?>&source=developerspot.co.ke" ></a></span>
<!--Pinterest button-->
<span><a target="_blank" class="fa fa-pinterest" href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonPin" data-pin-save="true" data-pin-custom="true"></a></span>
<!--WhataApp button-->
<span><a target="_blank" class="fa fa-whatsapp"
href="https://api.whatsapp.com/send?&text=<?php echo $posts['post_title'] ?> <?php echo $url;?>" data-action="share/whatsapp/share"></a></span>