<?php
require_once "src/Store.php";
$databaseDirectory = __DIR__ . "/myDatabase";
$store = new \SleekDB\Store("demo-harness", $databaseDirectory);


//API INSERT
if ($_GET['func'] == 'insert')
{
    delete($store, $_GET['name']);
    print_r(insert($store, $_GET['name'], $_GET['logo'], $_GET['background']));
}

//API DELETE
if ($_GET['func'] == 'delete')
{
    print_r(delete($store, $_GET['name']));
}

//API READ
if ($_GET['func'] == 'read')
{
    echo json_encode((read($store, $_GET['name'])));
}

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

function insert($store, $name, $logo, $background)
{

    $data = [
        'name' => $name,
        'logo' => $logo,
        'background' => $background
    ];

    $results = $store->insert($data);
    
    return $results;

}

function delete($store, $name)
{
    return $store->deleteBy(["name", "=", $name]);
}

function read($store, $name)
{
    $data = $store->findOneBy(["name", "=", $name]);
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