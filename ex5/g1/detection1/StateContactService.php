<?php

// 文件读写器

class StateContactService
{
    private $state;
    public function getState() {
          if (!isset($this->state)) { $this->initState(); } // effect
        return $this->state;
    }
    public function updateState($payload = "time ticking while page being visited") { }


    // effect
    private function loadStateFromFile() {
        if (file_exists('storageX'))
            $this->state = unserialize(file_get_contents('storageX'));
    }
    private function saveStateToFile() {
        file_put_contents('storageX', serialize($this->state));
    }

    // heavy effect, acturally
    private function initState() {
        $this->state = (new ContactRepository())->getContacts();
        if ( !is_array($this->state) || (is_array($this->state) && count($this->state) === 0)) { // 并不达标
            $this->state = [];
            $arr1 = [
                ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', 'id'=>1,],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
            ];
            $this->state = array_merge($this->state, $arr1);
        }
        // print_r("(State1Service) state Initialized");
        // print_r($this->state);
    }

    private function resetState() {
        $this->state = [];
          $this->saveStateToFile(); // effect
    }
}

