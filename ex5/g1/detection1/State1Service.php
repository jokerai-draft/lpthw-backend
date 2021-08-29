<?php

class State1Service implements IStateService
{
    private $state;
    public function getState() {
          if (!isset($this->state)) { $this->initState(); } // effect
        return $this->state;
    }
    public function updateState($payload = "ticking") {
        //   $this->initState(); // effect <- if you want to load it from memory directly to reduce disk-reading once, use singleton pattern as to hold data in memory accross classes. Or ref to 巨型状态机的比喻
          if (!isset($this->state)) { $this->initState(); } // effect                ^ 如果是一步步传递进来的 那么就不需要巨型状态机
        // work
        // $result = (int)floor(time() / 10); // plank result
        // work
        // 距 2000年1月1日零点
        $timeSpan = time() - (new \DateTime('2000-01-01'))->getTimestamp();
        $result = (int)floor($timeSpan / 10); // plank result
        if ($this->state['result'] === $result) {
            // $arr1['writtingTimes'] = ++$this->state['writtingTimes']; // crazy writting frequency
            // $this->state = array_merge($this->state, $arr1);
            // $this->saveStateToFile();
        }
        if ($this->state['result'] !== $result) {
            $arr1['result'] = $result;
            $arr1['writtingTimes'] = ++$this->state['writtingTimes'];
            $this->state = array_merge($this->state, $arr1);
            $this->saveStateToFile();
        }
    }
    // public function updateState($payload) { // int
    //       $this->initState(); // effect
    //     $this->state['counter'] += $payload; // new item add to list, get the new list
    //       $this->saveStateToFile();
    // }
    /*
    public function increment($payload) { // int
          $this->initState(); // effect
        $this->state['counter'] += $payload; // new item add to list, get the new list
        $this->state['step'] = $payload;
          $this->saveStateToFile();
    }
    public function decrement($payload) { // int
          $this->initState(); // effect
        $this->state['counter'] -= $payload; // new item add to list, get the new list
        $this->state['step'] = $payload;
          $this->saveStateToFile();
    }
    */



    // effect
    private function loadStateFromFile() {
        // echo "State1Service loadStateFromFile() called. " . PHP_EOL;
        if (file_exists('storage1'))
            $this->state = unserialize(file_get_contents('storage1'));
    }
    private function saveStateToFile() {
        file_put_contents('storage1', serialize($this->state));
    }

    // heavy effect, acturally
    private function initState() {
        // echo "State1Service initState() called. " . PHP_EOL;
        $this->loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array($this->state) || (is_array($this->state) && count($this->state) === 0)) { // 并不达标
            $this->state = [];
            $arr1 = ['result' => 1, 'writtingTimes' => 0, ];
            ++$arr1['writtingTimes'];
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
        // print_r("(State1Service) state Initialized");
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
