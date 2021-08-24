<?php
class StateService
{
    private static $state;
    public static function getState() {
          if (!isset(self::$state)) { self::initState(); } // effect
        return self::$state;
    }


    // effect
    private static function loadStateFromFile() {
        if (file_exists('storageX'))
            self::$state = unserialize(file_get_contents('storageX'));
    }
    private static function saveStateToFile() {
        file_put_contents('storageX', serialize(self::$state));
    }

    // heavy effect, acturally
    private static function initState() {
        self::loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array(self::$state) || (is_array(self::$state) && count(self::$state) === 0)) { // 并不达标
            self::$state = [];
            $arr1 = ['result' => 2, 'writtingTimes' => 0, ];
            ++$arr1['writtingTimes'];
            self::$state = array_merge(self::$state, $arr1);
            self::saveStateToFile();
        } else {
            // 很达标
            // 额外，如果需要修改
            if (false){
                $now = new DateTime();
                // var_export(gettype($now));
                // var_export(get_class($now));
                // self::$state[0] = "zero is me as always";
                self::$state[0] = $now->format('Y-m-d H:i:s');
                self::saveStateToFile();
            }
        }
        // print_r("(State1Service) state Initialized");
        // print_r(self::$state);
    }

    private static function resetState() {
        self::$state = [];
          self::saveStateToFile(); // effect
    }
}

