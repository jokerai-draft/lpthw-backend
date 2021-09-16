<?php
class SessionedStateService
{
    private $state;
    public function getState() {
          if (!isset($this->state)) { $this->initState(); } // effect
        return $this->state;
    }
    // public function updateState($payload) { // int
    //       $this->initState(); // effect
    //     $this->state['counter'] += $payload; // new item add to list, get the new list
    //       $this->saveStateToFile();
    // }

    public function login($payload) { // int
          if (!isset($this->state)) { $this->initState(); } // effect
        $credential = $payload;
        // $credential = ['username' => 'dave', 'password' => 'dave123', ];
        $auth = $this->tryLogin($credential);
        $isLoggedIn = $auth['isLoggedIn'];
        if ($isLoggedIn) {
            $this->state = ['isLoggedIn' => true,
                'lastLoginTime' => (new DateTime())->format('Y-m-d H:i:s'),
                'username' => $credential['username'],
                'user_id' => $auth['user_id'], ];
            // get the new state
        } else {
            $this->state = ['isLoggedIn' => false, 'lastLoginTime' => -1, 'username' => '', 'user_id' => -1, ];
        }
          $this->saveStateToFile();


        return $isLoggedIn;
    }

    public function logout() {
          if (!isset($this->state)) { $this->initState(); } // effect
        $arr1 = ['isLoggedIn' => false, 'lastLoginTime' => -1, 'username' => '', 'user_id' => -1, ];
        $this->state = array_merge($this->state, $arr1);
          $this->saveStateToFile();
    }


    // effect
    private function loadStateFromFile() {
        // echo "SessionedStateService loadStateFromFile() called. " . PHP_EOL;
        // if (file_exists('storageA'))
        //     $this->state = unserialize(file_get_contents('storageA'));
        $this->state['isLoggedIn'] = $_SESSION['isLoggedIn'] ?? false;
        $this->state['lastLoginTime'] = $_SESSION['lastLoginTime'] ?? -1;
        $this->state['username'] = $_SESSION['username'] ?? '';
        $this->state['user_id'] = $_SESSION['user_id'] ?? -1;
    }
    private function saveStateToFile() {
        // file_put_contents('storageA', serialize($this->state));
        foreach ($this->state as $k => $v) {
            $_SESSION[$k] = $v;
        }
    }

    // heavy effect, acturally
    private function initState() {
        // echo "SessionedStateService initState() called. " . PHP_EOL;
        $this->loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array($this->state) || (is_array($this->state) && count($this->state) === 0)) { // 并不达标
            $this->state = [];
            $arr1 = ['isLoggedIn' => false, 'lastLoginTime' => -1, 'username' => '', 'user_id' => -1, ];
            $this->state = array_merge($this->state, $arr1);
            $this->saveStateToFile();
        } else {
            // 很达标
            // 额外，如果需要修改
            if (false){
                $now = new DateTime();
                // var_export(gettype($now));
                // var_export(get_class($now));
                // $this->state[0] = "zero is me as always";
                $this->state[0] = $now->format('Y-m-d H:i:s');
                $this->saveStateToFile();
            }
        }
        // print_r("(SessionedStateService) state Initialized");
        // print_r($this->state);
    }

    private function resetState() {
        $this->state = ['isLoggedIn' => false, 'lastLoginTime' => -1, 'username' => '', 'user_id' => -1, ];
          $this->saveStateToFile(); // effect
    }
    public function reset() {
        $this->resetState();
    }

    /* try the username and password (credential), try to login against the users info in the db */
    private function tryLogin($credential) {
        $isLoggedIn = false;
        if (file_exists('loginMap')) {
            $source = unserialize(file_get_contents('loginMap'));
            $matched = array_filter($source, function($row) use ($credential) {
                if ($row['username'] === $credential['username'] && $row['password'] === $credential['password']){
                    return $row;
                }
            });
            if (count($matched) > 0) {
                $isLoggedIn = true;
            }
        }
        // return $isLoggedIn;
        if ($isLoggedIn) {
            $auth = ['isLoggedIn' => true, 'user_id' => $matched[array_key_last($matched)]['id'], 'username' => $matched[array_key_last($matched)]['username'], ];
        } else {
            $auth = ['isLoggedIn' => false, 'user_id' => -1, 'username' => '', ];
        }
        return $auth;
    }
}
