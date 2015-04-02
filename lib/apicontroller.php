<?php
require_once(__DIR__ . '/../config/config.php');
require_once(LIBS_DIR . '/rpcapi.php');

class ApiController {
    /**
     * Array mapping function names available in the API to their containing files in the apifunctions/ folder.
     */
    static $functions = array(
        'returnRandomString' => 'sillyfunctions.php'
    );

    /**
     * Get the API object.
     * @param string|null $uniqueRPC If specified, the API will only contain this RPC.
     * @return RPCAPI
     */
    static function GetApi($uniqueRPC=null) {
        $api = new RPCAPI();

        if (is_null($uniqueRPC) || !isset(self::$functions[$uniqueRPC])) {
            foreach (self::$functions as $name => $file) {
                self::_RequireFile($file);
                $api->addFunction($name);
            }
        } else {
            self::_RequireFile(self::$functions[$uniqueRPC]);
            $api->addFunction($uniqueRPC);
        }

        return $api;
    }

    /**
     * Require a file for the API.
     * @param string $name The name of the file in the apifunctions folder.
     * @private
     */
    static function _RequireFile($name) {
        require_once(LIBS_DIR . '/apifunctions/' . $name);
    }
}
