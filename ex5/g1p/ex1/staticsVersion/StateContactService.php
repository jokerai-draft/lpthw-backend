<?php

// 文件读写器

class StateContactService
{
    private static $state;
    public static function getState() {
          if (!isset(self::$state)) { self::initState(); } // effect
        return self::$state;
    }
    public static function updateState($payload = "time ticking while page being visited") { }


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
        $contactRepository = new ContactRepository();
        self::$state = $contactRepository->getContacts();
        if ( !is_array(self::$state) || (is_array(self::$state) && count(self::$state) === 0)) { // 并不达标
            self::$state = [];
            $arr1 = [
                ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', 'id'=>1,],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
            ];
            self::$state = array_merge(self::$state, $arr1);
        }
        // print_r("(State1Service) state Initialized");
        // print_r(self::$state);
    }

    private static function resetState() {
        self::$state = [];
          self::saveStateToFile(); // effect
    }
}

