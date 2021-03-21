<?php
session_start();


//ACTIONS
if ($_GET["action"] == "update-customer")
{
    $_SESSION["buyer"] = $_GET["value"];
    insertPref();
    die("New Session Name! customer: [".$_SESSION["buyer"]."]");
}

//ACTIONS
if ($_GET["action"] == "update-logo")
{
    $_SESSION["logo"] = $_GET["value"];
    insertPref();
    die("New Session Name! logo: [".$_SESSION["logo"]."]");
}

//ACTIONS
if ($_GET["action"] == "update-background")
{
    $_SESSION["background"] = $_GET["value"];
    insertPref();
    die("New Session Name! background: [".$_SESSION["background"]."]");
}



//NAME GENERATOR
function readable_random_string($length = 6)
{  
    $string     = '';
    $vowels     = array("a","e","i","o","u");  
    $consonants = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );  

    // Seed it
    srand((double) microtime() * 1000000);

    $max = $length/2;
    for ($i = 1; $i <= $max; $i++)
    {
        $string .= $consonants[rand(0,19)];
        $string .= $vowels[rand(0,4)];
    }

    return $string;
}


function readApi($name)
{
    //echo "DEBUG";
  //  echo "MY-DEBUG-READ".getenv("DB");
    $url = $_SESSION["DB"]."?func=read&name=".$name;
    $value = file_get_contents($url);
   // echo $value;
    $value = json_decode($value);
   // print_r($value);
    return $value;
}

function insertPref()
{
    writeApi($_SESSION["buyer"], $_SESSION["logo"], $_SESSION["background"]);
}

function writeApi($name, $logo, $background)
{
  //  echo "MY-DEBUG".getenv("DB");
    $url = $_SESSION["DB"]."?func=insert&name=".$name."&logo=".$logo."&background=".$background;
    $value = file_get_contents($url);
    echo $value;
 //   echo $url;
 //   print_r($value);
    return $value;
}


?>