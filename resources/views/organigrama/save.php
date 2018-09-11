<?php
console.log("j");
$data= $_REQUEST['base64data'];
$image=explode('base64', $data);
file_put_contents('1.jpg', base64_decode($image[1]));
dd("ver");
?>