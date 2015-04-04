<?php
require_once('../config/config.php');
require_once(LIBS_DIR . '/apicontroller.php');


class JSUtils {
    /**
     * Output a JS function that will create an API with methods declared in the PHP API.
     * @return string
     */
    static function CreateGlobalAPI() {
        $strParts = array(
            '(function() {',
            "   var apiConfig = new RpcApiConfig('" . API_URL . "');"
        );
        foreach (ApiController::$functions as $name => $file) {
            $strParts[] = "    apiConfig.declareFunction('" . $name . "');";
        }
        $strParts[] = 'return apiConfig.getApi();';
        $strParts[] = "})()";

        return implode("\n", $strParts);
    }

    /**
     * Ensure that a namespace exist
     * @param ...string $namespaces One or more namespaces to create.
     */
    static function EnsureNamespaceExists($namespaces) {
        // Create the tree of namespaces
        $tree = array();
        foreach (func_get_args() as $namespace) {
            $namespaceParts = explode('.', $namespace);
            $currPointer = &$tree;
            foreach ($namespaceParts as $part) {
                if (!isset($currPointer[$part])) {
                    $currPointer[$part] = array();
                    $currPointer = &$currPointer[$part];
                } else {
                    $currPointer = &$currPointer[$part];
                }
            }
        }


    }
}
