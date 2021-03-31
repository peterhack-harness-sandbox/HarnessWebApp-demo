<?php
include "auth-module.php";
header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
header("Pragma: no-cache"); //HTTP 1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past



if ($auth_version == 1)
    echo '<a href="#login"><div align="center"><img src="img/login-v2.png" id ="logo" width="100px" /></div></a>';
else
    echo '<a href="#error"><div align="center"><img src="img/login-image.png" id="newlogo"/></div></a>'; //new image

echo '<div align="center">'.$auth_message.'</div>';
?>