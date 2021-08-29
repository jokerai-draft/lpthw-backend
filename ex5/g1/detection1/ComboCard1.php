<?php
class ComboCard1
{
    private $state;
    public function __construct() {
        $this->state = [];
        // $this->state = array_merge($this->state, (new State1Service())->getState());
        $this->state[0] = (new State1Service())->getState();
        $this->state[1] = (new State2Service())->getState();
    }
    public function onNotif() {
        $this->state[0] = (new State1Service())->getState();
        $this->state[1] = (new State2Service())->getState();
        return $this;
    }
    public function getState() {
        return $this->state;
    }
}
