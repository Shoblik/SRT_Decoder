<?php

$response = [
    'success' => true,
    'errors' => [],
    'data' => null
];

if (isset($_GET['parseFile'])) {
    require(__DIR__ . '/../../controllers/ProcessFile.php');

    $processFile = new ProcessFile();

    $result = $processFile->go();

    $response['data'] = $result;

    echo json_encode($response);

    exit;
}