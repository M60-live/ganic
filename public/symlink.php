<?php
//$target = '/home/ganicrootsco/GanicRoots/storage/app/public';
$target = 'C:\wamp\www\ganic\storage\app\public';
$shortcut = 'storage'; 
symlink($target, $shortcut); 
?>