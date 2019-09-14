<?php
$webApiVersion = '0.1.0';

function sendResponse($apiResponse) {
    global $webApiVersion;

    $response = [
        'response' => $apiResponse,
        'jsonApiVersion' => $webApiVersion,
    ];

    echo json_encode($response);
}
