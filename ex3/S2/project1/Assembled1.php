<?php
class Assembled1
{
    public $httpMessageHandler;
    public $databag;
    public $view;
    public function __construct(){
        $this->view = "";
        $this->databag = [];

        $this->httpMessageHandler = [];
        $this->httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        // $this->httpMessageHandler['GET']  = $_GET;
        $this->httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        $this->httpMessageHandler['URL']  = htmlspecialchars($_SERVER['PHP_SELF']);
    }

    public function perform() {
        $this->fillDatabag(); // process before render
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view1.php', $map);
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }
    protected function fillDatabag() { // fillDatabag hooker
        // $this->databag['age'] = 13;
    }

}
