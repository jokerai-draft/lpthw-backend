<?php

require_once 'IContactRepository.php';
class ContactRepository implements IContactRepository
{
    public function __construct() {
        // $this->resetState();
    }

    public function getContacts() {
        $contacts = [];
        $contacts = $this->loadStateFromFile();
        return $contacts;
    }

    public function save($payload) {
        $contact = ['name' => $payload['name'], 'phone' => $payload['phone'], 'email' => $payload['email'], ];
        $contact['id'] = $this->getNewestId() + 1; // 也可以用雪花算法生成不重复的 uuid
        $contacts = $this->loadStateFromFile();
        $contacts[] = $contact;
        $this->saveStateToFile($contacts); // effect
        return $contact['id'];
    }

    public function update($payload) {
        $contacts = $this->loadStateFromFile();
        $id = $payload['id'];
        $found = array_filter($contacts, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) {
            // $item = $found[array_key_last($found)];
            $id = array_key_last($found);
            $contacts[$id]['name'] = $payload['name'];
            $contacts[$id]['phone'] = $payload['phone'];
            $contacts[$id]['email'] = $payload['email'];
            // $contacts[$id]['id'] = $payload['id']; ;
            $this->saveStateToFile($contacts); // effect
            return true;
        } else {
            // the contact doesn't exist
            return false;
        }
    }

    private function getNewestId() {
        $contacts = $this->loadStateFromFile();
        $lastContact = $contacts[array_key_last($contacts)];
        return (int)$lastContact['id'];
    }

    public function getContactById($id) {
        $contacts = $this->loadStateFromFile();
        $found = array_filter($contacts, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) {
            $item = $found[array_key_last($found)];
        } else {
            $item = ['name' => '-1', 'phone' => '-1', 'email' => '-1', 'id'=>-1,];
        }
        return $item;
    }

    public function delete($id) {
        $contacts = $this->loadStateFromFile();
        foreach ($contacts as $k => $v) {
            if ((int)$v['id'] === (int)$id) { unset($contacts[$k]); }
        }
        $this->saveStateToFile($contacts);
        return true;
    }

    // effect
    private function loadStateFromFile() {
        if (file_exists('storage')) {
            $contacts = unserialize(file_get_contents('storage'));
            if ( !is_array($contacts) || (is_array($contacts) && count($contacts) === 0)) { // 并不达标
                $contacts = [];
                $arr1 = [
                    ['name' => 'Alice', 'phone' => '000-000-9999', 'email' => 'alice@gmail.com', 'id'=>1,],
                    ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                    ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
                    ['name' => 'Dave', 'phone' => '431-129-3011', 'email' => 'dave@gmail.com', 'id'=>4,],
                    ['name' => 'Emma', 'phone' => '513-711-2921', 'email' => 'emma@gmail.com', 'id'=>5,],
                ];
                $contacts = array_merge($contacts, $arr1);
                $this->saveStateToFile($contacts);
            } else {
                // 很达标
                // 额外，如果需要修改
                if (false){
                    $now = new DateTime();
                    // var_export(gettype($now));
                    // var_export(get_class($now));
                    // $this->$state[0] = "zero is me as always";
                    $contacts[0] = $now->format('Y-m-d H:i:s');
                    $this->saveStateToFile($contacts);
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
            $this->saveStateToFile($contacts);
            return $contacts;
        }
    }
    private function saveStateToFile($payload) {
        file_put_contents('storage', serialize($payload));
    }
    private function resetState() {
        $contacts = [];
        $this->saveStateToFile($contacts); // effect
    }
    public function reset() {
        $this->resetState();
    }
}

