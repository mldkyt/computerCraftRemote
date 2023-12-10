<?php
if (isset($_GET['forward'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "forward";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['back'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "backward";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['right'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "right";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['left'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "left";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['update'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "update";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['down'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "down";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['up'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "up";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['select'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "select" . $_GET['select'];
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}
if (isset($_GET['refreshinv'])) {
    $data = json_decode(file_get_contents("action.json"));
    $data->action = "refreshinv";
    file_put_contents("action.json", json_encode($data));
    header("Location: /");
}

$data = json_decode(file_get_contents("action.json"));
if ($data->action == "") {
    $data->action = "none";
}

$data2 = json_decode(file_get_contents("data.json"));
?>
<html>
<head>
    <title>テスト</title>
    <meta http-equiv="refresh" content="5">
</head>
<body>
<p>Control the bot</p>
<p>Current: <?php echo $data->action; ?></p>
<p>Controller version: <?php echo $data2->client; ?></p>
<p>Block data:</p>
<ul>
    <li>Bottom: <?php echo $data2->bottom->block; ?></li>
    <li>Up: <?php echo $data2->up->block; ?></li>
    <li>Forward: <?php echo $data2->forward->block; ?></li>
</ul>
<p>Location: </p>
<ul>
    <?php
    if (isset($data2->pos)) {
        echo "<li>X: " . $data2->pos->x . "</li>";
        echo "<li>Y: " . $data2->pos->y . "</li>";
        echo "<li>Z: " . $data2->pos->z . "</li>";
    }
    else {
        echo "<li>Not found</li>";
    }
    ?>
</ul>
<a href="?forward=1">Go forward</a>
<a href="?back=1">Go back</a>
<a href="?right=1">Turn right</a>
<a href="?left=1">Turn left</a>
<a href="?down=1">Go down</a>
<a href="?up=1">Go up</a>
<a href="?update=1">Update / Restart</a>
<a href="?refreshinv=1">Refresh the inventory</a>
<table>
    <thead>
    <tr>
        <th>Slot</th>
        <th>Name</th>
        <th>Count</th>
        <th>Select</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($data2->inventory)) {
        foreach ($data2->inventory as $slot => $item) {
            if (!isset($item->name)) {
                continue;
            }
            if ($item->name == "air") {
                continue;
            }
            echo "<tr>";
            echo "<td>" . $slot . "</td>";
            echo "<td>" . $item->name . "</td>";
            echo "<td>" . $item->count . "</td>";
            echo "<td><a href=\"?select=" . $slot . "\">Select</a></td>";
            echo "</tr>";
        }
    }
    else {
        echo "<tr><td>Not found</td><td>Not found</td><td>Not found</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
