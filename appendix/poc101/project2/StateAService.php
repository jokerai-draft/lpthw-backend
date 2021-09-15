<?php
class StateAService
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
    public function updateState($payload) {
        if ($payload['operation'] === "+") {
            $this->increment($payload);
        }
        if ($payload['operation'] === "-") {
            $this->decrement($payload);
        }
    }
    public function increment($payload) { // int
          if (!isset($this->state)) { $this->initState(); } // effect
        $this->state['counter'] += (int)$payload['step']; // new item add to list, get the new list
        $this->state['step'] = (int)$payload['step'];
          $this->saveStateToFile();
    }
    public function decrement($payload) { // int
          if (!isset($this->state)) { $this->initState(); } // effect
        $this->state['counter'] -= (int)$payload['step']; // new item add to list, get the new list
        $this->state['step'] = (int)$payload['step'];
          $this->saveStateToFile();
    }



    // effect
    private function loadStateFromFile() {
        // echo "StateAService loadStateFromFile() called. " . PHP_EOL;
        if (file_exists('storageA'))
            $this->state = unserialize(file_get_contents('storageA'));
    }
    private function saveStateToFile() {
        file_put_contents('storageA', serialize($this->state));
    }

    // heavy effect, acturally
    private function initState() {
        // echo "StateAService initState() called. " . PHP_EOL;
        $this->loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array($this->state) || (is_array($this->state) && count($this->state) === 0)) { // 并不达标
            $this->state = [];
            $arr1 = ['counter' => 0, 'step' => 1, ];
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
        // print_r("(StateAService) state Initialized");
        // print_r($this->state);
    }

    private function resetState() {
        $this->state = [];
          $this->saveStateToFile(); // effect
    }
    public function reset() {
        $this->resetState();
    }
}
