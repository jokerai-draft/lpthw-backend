<?php
class State3Service
{
    private static $state;
    public static function getState() {
          if (!isset(self::$state)) { self::initState(); } // effect
        return self::$state;
    }

    // event handler
    public static function addContact($payload) {
          if (!isset(self::$state)) { self::initState(); } // effect
        $contact = ['name' => $payload['name'], 'phone' => $payload['phone'], 'email' => $payload['email'], ];
        self::$state[] = $contact;
          self::saveStateToFile(); // effect
    }

    // effect
    private static function loadStateFromFile() {
        if (file_exists('storage3'))
            self::$state = unserialize(file_get_contents('storage3'));
    }
    private static function saveStateToFile() {
        file_put_contents('storage3', serialize(self::$state));
    }

    // heavy effect, acturally
    private static function initState() {
        self::loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array(self::$state) || (is_array(self::$state) && count(self::$state) === 0)) { // 并不达标
            self::$state = [];
            $arr1 = [
                ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', ],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', ],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', ],
            ];
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

