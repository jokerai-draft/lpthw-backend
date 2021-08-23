<?php
class State1Service
{
    private static $state;
    public static function getState() {
          self::initState(); // effect
        return self::$state;
    }
    // public static function updateState($payload) { // int
    //       static::initState(); // effect
    //     self::$state['counter'] += $payload; // new item add to list, get the new list
    //       static::saveStateToFile();
    // }
    public static function increment($payload) { // int
          static::initState(); // effect
        self::$state['counter'] += $payload; // new item add to list, get the new list
        self::$state['step'] = $payload;
          static::saveStateToFile();
    }
    public static function decrement($payload) { // int
          static::initState(); // effect
        self::$state['counter'] -= $payload; // new item add to list, get the new list
        self::$state['step'] = $payload;
          static::saveStateToFile();
    }



    // effect
    private static function loadStateFromFile() {
        if (file_exists('storage1'))
            self::$state = unserialize(file_get_contents('storage1'));
    }
    private static function saveStateToFile() {
        file_put_contents('storage1', serialize(self::$state));
    }

    // heavy effect, acturally
    private static function initState() {
        self::loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array(self::$state) || (is_array(self::$state) && count(self::$state) === 0)) { // 并不达标
            self::$state = [];
            $arr1 = ['counter' => 0, 'step' => 1, ];
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
