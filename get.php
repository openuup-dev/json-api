<?php
require_once 'api/get.php';
require_once 'shared/main.php';
require_once 'shared/ratelimits.php';

$updateId = isset($_GET['id']) ? $_GET['id'] : null;
$usePack = isset($_GET['lang']) ? $_GET['lang'] : 0;
$desiredEdition = isset($_GET['edition']) ? $_GET['edition'] : 0;

header('Content-Type: application/json');

$resource = hash('sha1', strtolower("get-$updateId-$usePack-$desiredEdition"));
if(checkIfUserIsRateLimited($resource)) {
    http_response_code(429);
    sendResponse(['error' => 'USER_RATE_LIMITED']);
    die();
}

$apiResponse = uupGetFiles($updateId, $usePack, $desiredEdition, 1);
if(isset($apiResponse['error'])) {
    switch($apiResponse['error']) {
        case 'NO_FILES':
            http_response_code(500);
            break;

        case 'XML_PARSE_ERROR':
            http_response_code(500);
            break;

        case 'EMPTY_FILELIST':
            http_response_code(500);
            break;

        default:
            http_response_code(400);
    }
}

sendResponse($apiResponse);
