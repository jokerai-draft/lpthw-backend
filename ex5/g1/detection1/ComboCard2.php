<?php
class ComboCard2
{
    private $state;
    public function __construct() {
        $this->state = [];
        // $this->state = array_merge($this->state, (new State1Service())->getState());
        $this->state['ContactModel'] = (new StateContactService())->getState();
        $this->state['counter'] = (new State2Service())->getState();
    }
    public function onNotif() {
        $this->state['ContactModel'] = (new StateContactService())->getState();
        $this->state['counter'] = (new State2Service())->getState();
        return $this;
    }
    public function getState() {
        return $this->state;
    }
}
