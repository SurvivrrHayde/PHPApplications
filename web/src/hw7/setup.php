<?php

header('Content-Type: application/json');

if (isset($_GET['rows']) && isset($_GET['columns'])) {
    $rows = intval($_GET['rows']);
    $columns = intval($_GET['columns']);

    $total = $rows * $columns;

    if ($total < 10) {
        $lights_on = range(0, $total - 1);
    } else {
        $lights_on = array_rand(range(0, $total - 1), 10);
    }

    $response = [
        "rows" => $rows,
        "columns" => $columns,
        "lightsOn" => $lights_on
    ];

    echo json_encode($response);
} else {
    echo json_encode(["error" => "Rows and columns not provided"]);
}
