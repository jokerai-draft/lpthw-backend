<?php

class ItemController
{
    protected $component1;
    public $state;

    private $httpMessageHandler;
    private $databag;

    public function __construct($httpMessageHandler = [], $databag = []) {
        $this->httpMessageHandler = $httpMessageHandler;
        $this->databag = $databag;
        $this->state = [];
    }

    public function index() {
        // state
        $itemRepository = new ItemRepository();
        $this->state['items'] = $itemRepository->getItems();

        // performOut
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $this->databag['wat'] = "wat";
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.index.php', $map);
    }

    public function show($id) {
        // state
        $itemRepository = new ItemRepository();
        $this->state['item'] = $itemRepository->getItemById($id);

        // performOut
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.show.php', $map);
    }

    public function create() {
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.create.php', $map);
    }

    public function store() {
        // handle
        $payload['name']  = $this->httpMessageHandler['POST']['name'];
        $payload['phone'] = $this->httpMessageHandler['POST']['phone'];
        $payload['email'] = $this->httpMessageHandler['POST']['email'];
        $payload = array_map(fn($item) => trim($item), $payload);

        // state service
        $itemRepository = new ItemRepository();
        if ($itemRepository->save($payload)) {
            $id = (string)$itemRepository->getNewestId();
            header("Location: ./items.php?action=show&id=$id");
            exit();
        }
    }

    public function edit($id) {
        // state
        $itemRepository = new ItemRepository();
        $this->state['item'] = $itemRepository->getItemById($id);

        // performOut
        $payload = $this->state;
        $this->databag['state'] = $payload;
        $map = ['databag' => $this->databag, 'httpMessageHandler' => $this->httpMessageHandler, ];
        return self::view('view.item.edit.php', $map);
    }

    public function update($id) {
        // handle
        $payload['name']  = $this->httpMessageHandler['POST']['name'];
        $payload['phone'] = $this->httpMessageHandler['POST']['phone'];
        $payload['email'] = $this->httpMessageHandler['POST']['email'];
        $payload = array_map(fn($item) => trim($item), $payload);
        // $payload['id'] = $this->httpMessageHandler['POST']['id'];
        $payload['id'] = (int)$id;

        // state service
        $itemRepository = new ItemRepository();
        if ($itemRepository->update($payload)) {
            $id = (string)$payload['id'];
            header("Location: ./items.php?action=show&id=$id");
            exit();
        }
    }

    protected static function view($page, $databag = []) {
        extract($databag);
        require_once $page;
    }

}
