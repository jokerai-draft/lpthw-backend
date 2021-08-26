<?php

class ItemController
{
    protected $component1;
    public $state;

    private $httpMessageHandler;
    private $databag;

    public function __construct($httpMessageHandler = [], $databag = []) {
        // $this->component1 = new Component1();
        $this->httpMessageHandler = $httpMessageHandler;
        $this->databag = $databag;
        $this->state = [];
    }
    public function index() {
        // check state
        // State1Service::onNotif();
        // $this->state['items'] = State1Service::getState();

        $itemRepository = new ItemRepository();
        $this->state['items'] = $itemRepository->getItems();

        // dummyData
        // $addressBook = [
        //     ['name' => 'Alice', 'phone' => '000-000-0001', 'email' => 'alice@gmail.com', 'id'=>1,],
        //     ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
        //     ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
        // ];
        // $this->state['items'] = $addressBook; // OK
        // $this->state['greetings'] = "hello"; // OK

        // performOut
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $this->databag['wat'] = "wat";
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.index.php', $map);
    }
    public function index_() {
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
        // $itemRepository = new ItemRepository();
        // $this->databag['item'] = $itemRepository->getItemById($id);
        // $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        // return self::view('view.item.show.php', $map);

        $itemRepository = new ItemRepository();
        $this->state['item'] = $itemRepository->getItemById($id);
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.show.php', $map);
    }
    public function show_($id) {
        // dummyData
        $addressBook = [
            ['name' => 'Alice', 'phone' => '000-000-0000', 'email' => 'alice@gmail.com', 'id'=>1,],
            ['name' => 'Bill', 'phone' => '510-422-6710', 'email' => 'bill@gmail.com', 'id'=>2,],
            ['name' => 'Cindy', 'phone' => '513-739-2025', 'email' => 'cindy@gmail.com', 'id'=>3,],
        ];

        $found = array_filter($addressBook, function($item) use ($id) { return (int)$item['id'] === (int)$id; });
        if (count($found) === 1) { $this->databag['item'] = $found[array_key_last($found)]; }
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.show.php', $map);
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }

    public function create() {
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.create.php', $map);
    }
    public function store() {
        $payload['name']  = $this->httpMessageHandler['POST']['name'];
        $payload['phone'] = $this->httpMessageHandler['POST']['phone'];
        $payload['email'] = $this->httpMessageHandler['POST']['email'];
        $payload = array_map(fn($item) => trim($item), $payload);
        $itemRepository = new ItemRepository();
        if ($itemRepository->save($payload)) {
            $id = (string)$itemRepository->getNewestId();
            header("Location: ./items.php?action=show&id=$id");
            exit();
        }
    }
    public function edit($id) {
        $itemRepository = new ItemRepository();
        $this->state['item'] = $itemRepository->getItemById($id);
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.edit.php', $map);
    }
    public function update($id) {
        $payload['name']  = $this->httpMessageHandler['POST']['name'];
        $payload['phone'] = $this->httpMessageHandler['POST']['phone'];
        $payload['email'] = $this->httpMessageHandler['POST']['email'];
        $payload = array_map(fn($item) => trim($item), $payload);
        // $payload['id'] = $this->httpMessageHandler['POST']['id'];
        $payload['id'] = (int)$id;
        $itemRepository = new ItemRepository();
        if ($itemRepository->update($payload)) {
            $id = (string)$payload['id'];
            header("Location: ./items.php?action=show&id=$id");
            exit();
        }
    }
}
