<?php
require_once '../config/config.php';
require_once LIBS_DIR . '/includefunctions.php';
require_once LIBS_DIR . '/jsutils.php';

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Boilerplate Page</title>

        <?=IncludeFunctions::IncludeJS('vendor/rpcapi.pure', false)?>
        <?=IncludeFunctions::IncludeJS('vendor/phaser')?>

        <?=IncludeFunctions::IncludeJS('base')?>
        <?=IncludeFunctions::IncludeAllJS('src')?>
    </head>

    <body>
        <p>The root of your site is <?=SITE_ROOT?>, and you are serving this webpage from <?=URL_ROOT?>.</p>

        <p>Here is your JavaScript config:</p>
        <div id="config"></div>

        <p>
            Click this button to make an API call to the test endpoint:
            <button onclick="callTheAPI()">CALL</button>
        </p>
        <div id="api-result"></div>

        <script type="text/javascript">
            // Initialize the JS
            robin.Main(<?=json_encode($JS_CONFIG)?>, <?=JSUtils::CreateGlobalAPI()?>);
        </script>
    </body>
</html>
