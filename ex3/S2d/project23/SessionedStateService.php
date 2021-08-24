<?php
class SessionedStateService
{
    private static $state;
    public static function getState() {
          if (!isset(self::$state)) { self::initState(); } // effect
        return self::$state;
    }
    /*
    public static function updateState($payload = "time ticking while page being visited") {
          if (!isset(self::$state)) { self::initState(); } // effect
        // work
        // $result = (int)floor(time() / 10); // plank result
        // work
        // 距 2000年1月1日零点
        $timeSpan = time() - (new \DateTime('2000-01-01'))->getTimestamp();
        $result = (int)floor($timeSpan / 10); // plank result
        if (self::$state['result'] === $result) {
            $arr1['writtingTimes'] = ++self::$state['writtingTimes']; // crazy writting frequency
            self::$state = array_merge(self::$state, $arr1);
            self::saveStateToFile();
        }
        if (self::$state['result'] !== $result) {
            $arr1['result'] = $result;
            $arr1['writtingTimes'] = ++self::$state['writtingTimes'];
            self::$state = array_merge(self::$state, $arr1);
            self::saveStateToFile();
        }
    }*/
    // public static function updateState($payload) { // int
    //       static::initState(); // effect
    //     self::$state['counter'] += $payload; // new item add to list, get the new list
    //       static::saveStateToFile();
    // }
    /*
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
    */
    public static function tryLogin($payload = []){
        $arr1 = ['isLoggedIn' => true, 'lastLoginTime' => (new DateTime())->format('Y-m-d H:i:s'), ];
        self::$state = array_merge(self::$state, $arr1);
        self::saveStateToFile();
    }
    public static function logout() {
        $arr1 = ['isLoggedIn' => false, 'lastLoginTime' => -1, ];
        self::$state = array_merge(self::$state, $arr1);
        self::saveStateToFile();
    }



    // effect
    /*
    private static function loadStateFromFile() {
        if (file_exists('storageSession'))
            self::$state = unserialize(file_get_contents('storageSession'));
    }
    private static function saveStateToFile() {
        file_put_contents('storageSession', serialize(self::$state));
    }
    */
    private static function loadStateFromFile() {
        self::$state['isLoggedIn'] = $_SESSION['isLoggedIn'] ?? false;
        self::$state['lastLoginTime'] = $_SESSION['lastLoginTime'] ?? -1;
    }
    private static function saveStateToFile() {
        foreach (self::$state as $k => $v) {
            $_SESSION[$k] = $v;
        }
    }

    // heavy effect, acturally
    private static function initState() {
        self::loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array(self::$state) || (is_array(self::$state) && count(self::$state) === 0)) { // 并不达标
            self::$state = [];
            // $arr1 = ['isLoggedIn' => false, ];
            $arr1 = ['isLoggedIn' => false, 'lastLoginTime' => -1, ];
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
