<?php
// appendix/poc103/project1/ContactRepository.php

class ContactRepository implements IContactRepository
{
    public function __construct() {
        // $this->resetState();
    }

    public function getAll() {
        $entities = [];
        $entities = $this->loadStateFromFile();
        return $entities;
    }

    public function save($payload) {
        $entity = ['name' => $payload['name'], 'phone' => $payload['phone'], 'email' => $payload['email'], ];
        $entity['id'] = $this->getLastId() + 1; // 也可以用雪花算法生成不重复的 uuid
        $entities = $this->loadStateFromFile();
        $entities[] = $entity;
        $this->saveStateToFile($entities); // effect
        return $entity['id'];
    }

    public function update($payload) {
        $entities = $this->loadStateFromFile();
        $id = $payload['id'];
        $found = array_filter($entities, function($entity) use ($id) { return (int)$entity['id'] === (int)$id; });
        if (count($found) === 1) {
            // $entity = $found[array_key_last($found)];
            $id = array_key_last($found);
            $entities[$id]['name'] = $payload['name'];
            $entities[$id]['phone'] = $payload['phone'];
            $entities[$id]['email'] = $payload['email'];
            // $entities[$id]['id'] = $payload['id']; ;
            $this->saveStateToFile($entities); // effect
            return true;
        } else {
            // the entity doesn't exist
            return false;
        }
    }

    private function getLastId() {
        $entities = $this->loadStateFromFile();
        $lastEntity = $entities[array_key_last($entities)];
        return (int)$lastEntity['id'];
    }

    public function getById($id) {
        $entities = $this->loadStateFromFile();
        $found = array_filter($entities, function($entity) use ($id) { return (int)$entity['id'] === (int)$id; });
        if (count($found) === 1) {
            $entity = $found[array_key_last($found)];
        } else {
            $entity = ['name' => '-1', 'phone' => '-1', 'email' => '-1', 'id'=>-1,];
        }
        return $entity;
    }

    public function delete($id) {
        $entities = $this->loadStateFromFile();
        foreach ($entities as $k => $v) {
            if ((int)$v['id'] === (int)$id) { unset($entities[$k]); }
        }
        $this->saveStateToFile($entities);
        return true;
    }

    // effect
    private function loadStateFromFile() {
        if (file_exists('storage')) {
            $entities = unserialize(file_get_contents('storage'));
            if ( !is_array($entities) || (is_array($entities) && count($entities) === 0)) { // 并不达标
                $entities = [];
                $arr1 = [
                    ['name' => 'Alice', 'phone' => '000-000-9999', 'email' => 'alice@gmail.com', 'id'=>1,],
                    ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                    ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
                    ['name' => 'Dave', 'phone' => '431-129-3011', 'email' => 'dave@gmail.com', 'id'=>4,],
                    ['name' => 'Emma', 'phone' => '513-711-2921', 'email' => 'emma@gmail.com', 'id'=>5,],
                ];
                $entities = array_merge($entities, $arr1);
                $this->saveStateToFile($entities);
            } else {
                // 很达标
                // 额外，如果需要修改
                if (false){
                    $now = new DateTime();
                    // var_export(gettype($now));
                    // var_export(get_class($now));
                    // $this->$state[0] = "zero is me as always";
                    $entities[0] = $now->format('Y-m-d H:i:s');
                    $this->saveStateToFile($entities);
                }
            }
            return $entities;
        }
        if (!file_exists('storage')) {
            $entities = [];
            $dummyEntities = [
                ['name' => 'Alice', 'phone' => '000-000-9999', 'email' => 'alice@gmail.com', 'id'=>1,],
                ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
                ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
            ];
            $entities = array_merge($entities, $dummyEntities);
            $this->saveStateToFile($entities);
            return $entities;
        }
    }
    private function saveStateToFile($payload) {
        file_put_contents('storage', serialize($payload));
    }
    private function resetState() {
        $entities = [];
        $this->saveStateToFile($entities); // effect
    }
    public function reset() {
        $this->resetState();
    }
}
