<?php

// ex3/S2d/project24/ItemRepository.php
class ContactRepository
{
    public function __construct() {
        // self::resetState();
    }

    public function getContacts() {
        $contacts = [];
        $contacts = self::loadStateFromFile();
        return $contacts;
    }

    public function save($payload) {
        $contact = ['name' => $payload['name'], 'phone' => $payload['phone'], 'email' => $payload['email'], ];
        $contact['id'] = self::getNewestId() + 1;
        $contacts = self::loadStateFromFile();
        $contacts[] = $contact;
        self::saveStateToFile($contacts); // effect
        return true;
    }

    public function update($payload) {
        $contacts = self::loadStateFromFile();
        $id = $payload['id'];
        $found = array_filter($contacts, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) {
            // $item = $found[array_key_last($found)];
            $id = array_key_last($found);
            $contacts[$id]['name'] = $payload['name'];
            $contacts[$id]['phone'] = $payload['phone'];
            $contacts[$id]['email'] = $payload['email'];
            // $contacts[$id]['id'] = $payload['id'];
            self::saveStateToFile($contacts); // effect
            return true;
        } else {
            return false;
        }
    }

    public static function getNewestId() {
        $contacts = self::loadStateFromFile();
        $lastContact = $contacts[array_key_last($contacts)];
        return (int)$lastContact['id'];
    }

    public function getContactById($id) {
        $contacts = self::loadStateFromFile();
        $found = array_filter($contacts, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) {
            $item = $found[array_key_last($found)];
        } else {
            $item = ['name' => '-1', 'phone' => '-1', 'email' => '-1', 'id'=>-1,];
        }
        return $item;
    }

    // effect
    private static function loadStateFromFile() {
        if (file_exists('storage')) {
            $contacts = unserialize(file_get_contents('storage'));
            if ( !is_array($contacts) || (is_array($contacts) && count($contacts) === 0)) { // 并不达标
                $contacts = [];
                $arr1 = [
                    ['name' => 'Alice', 'phone' => '000-000-9999', 'email' => 'alice@gmail.com', 'id'=>1,],
                    ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                    ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
                ];
                $contacts = array_merge($contacts, $arr1);
                self::saveStateToFile($contacts);
            } else {
                // 很达标
                // 额外，如果需要修改
                if (false){
                    $now = new DateTime();
                    // var_export(gettype($now));
                    // var_export(get_class($now));
                    // self::$state[0] = "zero is me as always";
                    $contacts[0] = $now->format('Y-m-d H:i:s');
                    self::saveStateToFile($contacts);
                }
            }
            return $contacts;
        }
        if (!file_exists('storage')) {
            $contacts = [];
            $addressBook = [
                ['name' => 'Alice', 'phone' => '000-000-9999', 'email' => 'alice@gmail.com', 'id'=>1,],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
            ];
            $contacts = array_merge($contacts, $addressBook);
            self::saveStateToFile($contacts);
            return $contacts;
        }
    }
    private static function saveStateToFile($payload) {
        file_put_contents('storage', serialize($payload));
    }
    private static function resetState() {
        $contacts = [];
        self::saveStateToFile($contacts); // effect
    }
}

