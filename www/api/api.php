<?php
require_once(__DIR__ . '/../../config/config.php');
require_once(LIBS_DIR . '/apicontroller.php');


$api = ApiController::GetApi($_GET['rpc']);
$api->respondToRequest();
