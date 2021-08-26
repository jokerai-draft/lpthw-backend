<?php

class ItemController
{
    protected $component1;
    private $httpMessageHandler;
    private $databag;

    public function __construct($httpMessageHandler = [], $databag = []) {
        // $this->component1 = new Component1();
        $this->httpMessageHandler = $httpMessageHandler;
        $this->databag = $databag;
    }
    public function index() {
        $payload = [];
        $this->databag['level2payload'] = $payload;
        // dummyData
        $addressBook = [
            ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', 'id'=>'1',],
            ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>'2',],
            ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>'3',],
        ];
        $this->databag['items'] = $addressBook; // OK
        $this->databag['greetings'] = "hello"; // OK
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.index.php', $map);
    }
    public function show($id) {
        // dummyData
        $addressBook = [
            ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', 'id'=>'1',],
            ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>'2',],
            ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>'3',],
        ];
        $found = array_filter($addressBook, function($item) use ($id) { return $item['id'] === (string)$id; });
        if (count($found) === 1) { $this->databag['item'] = $found[array_key_last($found)]; }
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.show.php', $map);
    }
    public function create() {
        self::$databag['age'] = 12;
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.create.php', $map);
    }
    public function edit() {

    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }

}
