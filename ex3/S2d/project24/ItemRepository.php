<?php

class ItemRepository
{
    public function __construct() {
        // self::resetState();
    }

    public function getItems() {
        $items = [];
        $items = self::loadStateFromFile();
        return $items;
    }

    public function save($payload) {
        $contact = ['name' => $payload['name'], 'phone' => $payload['phone'], 'email' => $payload['email'], ];
        $contact['id'] = self::getNewestId() + 1;
        $items = self::loadStateFromFile();
        $items[] = $contact;
        self::saveStateToFile($items); // effect
        return true;
    }

    public function update($payload) {
        $items = self::loadStateFromFile();
        $id = $payload['id'];
        $found = array_filter($items, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) {
            // $item = $found[array_key_last($found)];
            $id = array_key_last($found);
            $items[$id]['name'] = $payload['name'];
            $items[$id]['phone'] = $payload['phone'];
            $items[$id]['email'] = $payload['email'];
            // $items[$id]['id'] = $payload['id'];
            self::saveStateToFile($items); // effect
            return true;
        } else {
            return false;
        }
    }

    public static function getNewestId() {
        $items = self::loadStateFromFile();
        $lastItem = $items[array_key_last($items)];
        return (int)$lastItem['id'];
    }

    public function getItemById($id) {
        $items = self::loadStateFromFile();
        $found = array_filter($items, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
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
            $items = unserialize(file_get_contents('storage'));
            if ( !is_array($items) || (is_array($items) && count($items) === 0)) { // 并不达标
                $items = [];
                $arr1 = [
                    ['name' => 'Alice', 'phone' => '000-000-0010', 'email' => 'alice@gmail.com', 'id'=>1,],
                    ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                    ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
                ];
                $items = array_merge($items, $arr1);
                self::saveStateToFile($items);
            } else {
                // 很达标
                // 额外，如果需要修改
                if (false){
                    $now = new DateTime();
                    // var_export(gettype($now));
                    // var_export(get_class($now));
                    // self::$state[0] = "zero is me as always";
                    $items[0] = $now->format('Y-m-d H:i:s');
                    self::saveStateToFile($items);
                }
            }
            return $items;
        }
        if (!file_exists('storage')) {
            $items = [];
            $addressBook = [
                ['name' => 'Alice', 'phone' => '000-000-0010', 'email' => 'alice@gmail.com', 'id'=>1,],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
            ];
            $items = array_merge($items, $addressBook);
            self::saveStateToFile($items);
            return $items;
        }
    }
    private static function saveStateToFile($payload) {
        file_put_contents('storage', serialize($payload));
    }
    private static function resetState() {
        $items = [];
        self::saveStateToFile($items); // effect
    }
}
