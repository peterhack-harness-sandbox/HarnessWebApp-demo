<?php


//API VERIFICATION
if ($_GET['func'] == 'verif')
{
    $url = "http://harness-app.cointet.com/result.php";

    $value = @file_get_contents($url);
    if (stripos($value, "captain-america"))
       $info = false;
    else
        $info = true;
    
    echo json_encode(buildVerif($info, $value));
}

function buildVerif($error, $value)
{
    $data[] = array (
        "hostname"  => "my-web-server",
        "level" => "warning",
        "message"   => "bad display on iPhone11 - bad layer position for the user",
        "@timestamp" => time()
    );

    if ($error)
    {
    $newtime = time() - 5;
    $data[] = array (
        "hostname"  => "my-web-server",
        "level" => "error",
        "message"   => "Image: not Canary Captain America",
        "@timestamp" => $newtime
    );
    }


    $error_message = get_string_between($value, 'id="error_message">', "</div>");
    if (strlen($error_message) > 1)
    {
        $newtime = time() - 5;
        $data[] = array (
            "hostname"  => "my-web-server",
            "level" => "error",
            "message"   => $error_message,
            "@timestamp" => $newtime
        );

    }

//if ($error)
  //  array_push($data, $dataerror);

return $data;

}


function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

?>