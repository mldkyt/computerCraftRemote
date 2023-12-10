<?php
if (isset($_GET["version"])) {
    echo "API version 1.0";
}

if (isset($_GET["bottomname"])) {
    $data = json_decode(file_get_contents("data.json"));
    $data->bottom = array(
        "block" => $_GET["bottomname"]
    );
    file_put_contents("data.json", json_encode($data));
}
if (isset($_GET["upname"])) {
    $data = json_decode(file_get_contents("data.json"));
    $data->up = array(
        "block" => $_GET["upname"]
    );
    file_put_contents("data.json", json_encode($data));
}
if (isset($_GET["forwardname"])) {
    $data = json_decode(file_get_contents("data.json"));
    $data->forward = array(
        "block" => $_GET["forwardname"]
    );
    file_put_contents("data.json", json_encode($data));
}
if (isset($_GET["x"]) and isset($_GET["y"]) and isset($_GET["z"])) {
    $data = json_decode(file_get_contents("data.json"));
    $data->pos = array(
        "x" => $_GET["x"],
        "y" => $_GET["y"],
        "z" => $_GET["z"]
    );
    file_put_contents("data.json", json_encode($data));
}
if (isset($_GET['posnotfound'])) {
    $data = json_decode(file_get_contents("data.json"));
    if (isset($data->pos)) {
        unset($data->pos);
    }
    file_put_contents("data.json", json_encode($data));
}
if (isset($_GET["invslot"]) and isset($_GET["invname"]) and isset($_GET["invcount"])) {
    $data = json_decode(file_get_contents("data.json"));
    if (!isset($data->inventory)) {
        $data->inventory = array();
    }
    $data->inventory = (array)$data->inventory;
    if (!isset($data->inventory[$_GET["invslot"]])) {
        $data->inventory[$_GET["invslot"]] = array();
    }
    $data->inventory[$_GET["invslot"]] = array(
        "name" => $_GET["invname"],
        "count" => $_GET["invcount"]
    );

    file_put_contents("data.json", json_encode($data));
}

if (isset($_GET['clientver'])) {
    $data = json_decode(file_get_contents("data.json"));
    $data->client = $_GET['clientver'];
    file_put_contents("data.json", json_encode($data));
}

$data = json_decode(file_get_contents("action.json"));
file_put_contents("action.json", json_encode(array(
    "action" => ""
)));
echo $data->action;
