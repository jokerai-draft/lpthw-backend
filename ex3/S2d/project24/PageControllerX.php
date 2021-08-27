<?php

class PageControllerX
{
    public $state;

    private $httpMessageHandler;
    private $databag;

    public function __construct($httpMessageHandler = [], $databag = []) {
        $this->httpMessageHandler = $httpMessageHandler;
        $this->databag = $databag;
        $this->state = [];
    }

    public function start() { // 参考 Hub3.php start() 的写法
        // state
        $this->state['greetings'] = "halo"; // should come from an self-updated object

        // perform
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $this->databag['wat'] = "wat";
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view1X.php', $map);
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
}
