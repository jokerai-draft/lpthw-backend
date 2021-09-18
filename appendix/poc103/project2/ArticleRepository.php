<?php
// appendix/poc103/project1WITHARTICLE/ArticleRepository.php

class ArticleRepository implements IArticleRepository
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
        $entity = ['title' => $payload['title'], 'body' => $payload['body'], 'user_id' => (int)$payload['user_id'], ];
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
            $entities[$id]['title'] = $payload['title'];
            $entities[$id]['body'] = $payload['body'];
            // $entities[$id]['id'] = $payload['id'];
            // $entities[$id]['user_id'] = $payload['user_id'];
            $this->saveStateToFile($entities); // effect
            return true;
        } else {
            // the contact doesn't exist
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
            $entity = ['title' => '-1', 'body' => '-1', 'user_id' => '-1', 'id'=>-1,];
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
                    ['id' => 1, 'user_id' => 1, 'title' => 'Title1', 'body' => 'Body1'],
                    ['id' => 2, 'user_id' => 1, 'title' => 'Title2', 'body' => 'Body2'],
                    ['id' => 3, 'user_id' => 1, 'title' => 'Title3', 'body' => 'Body3'],
                    ['id' => 4, 'user_id' => 2, 'title' => 'Title4', 'body' => 'Body4'],
                    ['id' => 5, 'user_id' => 2, 'title' => 'Title5', 'body' => 'Body5'],
                    ['id' => 6, 'user_id' => 3, 'title' => 'Title6', 'body' => 'Body6'],
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
            $arr1 = [
                ['id' => 1, 'user_id' => 1, 'title' => 'Title1', 'body' => "exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum"],
                ['id' => 2, 'user_id' => 1, 'title' => 'Title2', 'body' => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est"],
                ['id' => 3, 'user_id' => 1, 'title' => 'Title3', 'body' => "If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin"],
                ['id' => 4, 'user_id' => 2, 'title' => 'Title4', 'body' => 'Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure'],
                ['id' => 5, 'user_id' => 2, 'title' => 'Title5', 'body' => "dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem"],
                ['id' => 6, 'user_id' => 3, 'title' => 'Title6', 'body' => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit"],
            ];
            $entities = array_merge($entities, $arr1);
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
