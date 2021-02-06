<?php
$webApiVersion = '0.2.1';

function sendResponse($apiResponse) {
    global $webApiVersion;

    $response = [
        'response' => $apiResponse,
        'jsonApiVersion' => $webApiVersion,
    ];

    echo json_encode($response)."\n";
}
