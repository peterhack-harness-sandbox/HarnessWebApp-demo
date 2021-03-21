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

?>