<?php

class DBConnection {
    private static $connected = false;

    /**
     * Connect to the database.
     */
    static function Connect() {
        if (!self::$connected) {
            mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die('Could not connect to MySQL');
            mysql_select_db(MYSQL_DB) or die('Failed to access the database');
            self::$connected = true;
        }
    }

    /**
     * Modify an existing array by removing any numeric keys from it.
     */
    static function UnsetNumericKeys(&$arr) {
        foreach ($arr as $key => $value) {
            if (is_int($key)) {
                unset($arr[$key]);
            }
        }
    }

    /**
     * Run an SQL query and return an array containing sub-arrays of results.
     */
    static function ObjectFromQuery($query) {
        if (!self::$connected) {
            self::Connect();
        }
        $resource = mysql_query($query) or die(mysql_error());
        $result = array();
        if ($resource !== false) {
            while ($row = mysql_fetch_array($resource)) {
                $resultRow = array();
                foreach ($row as $key => $value) {
                    if (!is_int($key)) {
                        if (is_numeric($value)) {
                            $resultRow[$key] = floatval($value);
                        } else {
                            $resultRow[$key] = $value;
                        }
                    }
                }
                $result[] = $resultRow;
            }
        }
        return $result;
    }

    /**
     * Upsert an object into a table. On duplicate primary key, this will update the old values.
     * @param string tableName The name of the table to insert to
     * @param array[] objectList An array of objects, each with keys representing new column values
     */
    static function UpsertObjects($tableName, $objectList) {
        if (!self::$connected) {
            self::Connect();
        }
        // Get the columns that we'll be updating
        $columns = array_keys($objectList[0]);
        for ($i = 0; $i < count($columns); ++$i) {
            $columns[$i] = mysql_real_escape_string($columns[$i]);
        }
        $columnOrder = implode(', ', $columns);

        $queryParts = array();
        foreach ($objectList as $row) {
            $rowValues = array();
            foreach ($columns as $col) {
                if (is_string($row[$col])) {
                    $rowValues[] = "'".mysql_real_escape_string($row[$col])."'";
                } else {
                    $rowValues[] = $row[$col];
                }
            }
            $queryParts[] = '(' . implode(', ', $rowValues) . ')';
        }
        $values = implode(', ', $queryParts);

        $query = sprintf("REPLACE INTO %s (%s) VALUES %s", $tableName, $columnOrder, $values);
        mysql_query($query) or die(mysql_error());
    }
}
