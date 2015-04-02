<?php
require_once('../config/config.php');
require_once(LIBS_DIR . '/apicontroller.php');


class JSUtils {
    /**
     * Output JS configuration code that can be used in the global namespace.
     * @param string $namespace If specified, configuration will be stored here instead.
     */
    static function CreateGlobalJSConfig($namespace=null) {
        if (!is_null($namespace)) {
            echo $namespace . " = {};\n";
            $prefix = $namespace . '.';
        } else {
            $prefix = '';
        }
        global $JS_CONFIG;
        foreach ($JS_CONFIG as $key => $value) {
            echo $prefix . $key . ' = ' . json_encode($value) . ";\n";
        }
    }

    /**
     * Output JS configuration code that creates an RPC API that has all available methods.
     * @param string $objectName The name of the object where the RPC
     */
    static function CreateGlobalAPI($objectName) {
        $strParts = array(
            $objectName . ' = (function() {',
            "   var apiConfig = new RpcApiConfig('" . API_URL . "');"
        );
        foreach (ApiController::$functions as $name => $file) {
            $strParts[] = "    apiConfig.declareFunction('" . $name . "');";
        }
        $strParts[] = 'return apiConfig.getApi();';
        $strParts[] = "})();";

        echo implode("\n", $strParts);
    }

    /**
     * Ensure that a namespace exists.
     */
    static function EnsureNamespaceExists($namespace) {
        $namespaceParts = explode('.', 'window.' . $namespace);
        $allParts = '';
        foreach ($namespaceParts as $part) {
            $allParts .= $part;
            echo $allParts . ' || (' . $allParts . " = {});\n";
            $allParts .= '.';
        }
    }
}
