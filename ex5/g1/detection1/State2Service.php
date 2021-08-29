<?php

class State2Service implements IStateService
{
    private $state;
    public function getState() {
          if (!isset($this->state)) { $this->initState(); } // effect
        return $this->state;
    }
    public function updateState($payload = "time ticking while page being visited") {
          if (!isset($this->state)) { $this->initState(); } // effect
        // work
        // $result = (int)floor(time() / 10); // plank result
        // work
        // 距 2000年1月1日零点
        $timeSpan = time() - (new \DateTime('2000-01-01'))->getTimestamp();
        $result = (int)floor($timeSpan / 10); // plank result
        if ($this->state['result'] === $result) {
            $arr1['writtingTimes'] = ++$this->state['writtingTimes']; // crazy writting frequency
            $this->state = array_merge($this->state, $arr1);
            $this->saveStateToFile();
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
        if (file_exists('storage2'))
            $this->state = unserialize(file_get_contents('storage2'));
    }
    private function saveStateToFile() {
        file_put_contents('storage2', serialize($this->state));
    }

    // heavy effect, acturally
    private function initState() {
        $this->loadStateFromFile(); // read from persistence layer 固化层: read from file, from db, from session
        if ( !is_array($this->state) || (is_array($this->state) && count($this->state) === 0)) { // 并不达标
            $this->state = [];
            $arr1 = ['result' => 2, 'writtingTimes' => 0, ];
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
