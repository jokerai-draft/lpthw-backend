<?php

class ArticleController
{
    private $httpMessageHandler;
    public function __construct() {
        $this->httpMessageHandler = [];
        $this->httpMessageHandler['GET']  = array_map(fn($item) => Utils::escape($item), $_GET);
        $this->httpMessageHandler['POST'] = array_map(fn($item) => Utils::escape($item), $_POST);
        $this->httpMessageHandler['SESSION'] = array_map(fn($item) => Utils::escape($item), $_SESSION);
        $this->httpMessageHandler['URL'] = htmlspecialchars($_SERVER['PHP_SELF']);
        $this->httpMessageHandler['SERVER'] = $_SERVER;
        $this->httpMessageHandler['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
        $this->httpMessageHandler['QUERY_STRING'] = $_SERVER['QUERY_STRING'] ?? "";
    }

    public function index() {
        // middleware
        $this->authMiddleware();

        $this->state['articles'] = (new ArticleRepository())->getAll();
        $this->articlePolicyHelper($this->state['articles']);

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.article.index.php');
    }

    public function show($id) {
        // middleware
        $this->authMiddleware();

        $this->state['article'] = (new ArticleRepository())->getById($id);
          $articles = [&$this->state['article'], ]; // pointer
        $this->articlePolicyHelper($articles);
          unset($articles);

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.article.show.php');
    }

    public function edit($id) {
        // middleware
        $this->authMiddleware();
        $this->articlePolicyMiddleware($id);

        $this->state['article'] = (new ArticleRepository())->getById($id);

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.article.edit.php');
    }

    public function create() {
        // middleware
        $this->authMiddleware();

        $this->state = [];

        $assmebled = new Assembled();
        $assmebled->performIn($this->state);
        $assmebled->performOut('view.article.create.php');
    }
    // store, update, destroy
    public function store() {
        // middleware
        $this->authMiddleware();

        // handle ... 数据过滤
        $payload = ['title' => $this->httpMessageHandler['POST']['title'],
          'body' => $this->httpMessageHandler['POST']['body'],
          'user_id' => $this->httpMessageHandler['POST']['user_id'], ];
        $payload = array_map(fn($item) => trim($item), $payload);
        $payload['user_id'] = (int)$payload['user_id'];

        // handle
        $id = (new ArticleRepository())->save($payload);

        // getState
        $this->state['article']['id'] = $id;

        // 相当于 perform
        header("Location: ./index.php?theme=articles&action=show&id={$this->state['article']['id']}&controller=ArticleController");
        exit();
    }

    public function update($id) {
        // middleware
        $this->authMiddleware();
        $this->articlePolicyMiddleware($id);

        // handle ... 数据过滤
        $payload = ['title' => $this->httpMessageHandler['POST']['title'],
          'body' => $this->httpMessageHandler['POST']['body'],
          'user_id' => $this->httpMessageHandler['POST']['user_id'], ];
        $payload = array_map(fn($item) => trim($item), $payload);
        // $payload['id'] = $this->httpMessageHandler['POST']['id'];
        $payload['user_id'] = (int)$payload['user_id'];
        $payload['id'] = (int)$id;

        // handle
        (new ArticleRepository())->update($payload); // should be true

        // getState
        $this->state['article']['id'] = $id;

        // 相当于 perform
        header("Location: ./index.php?theme=articles&action=show&id={$this->state['article']['id']}&controller=ArticleController");
        exit();
    }

    public function destroy($id) {
        // middleware
        $this->authMiddleware();
        $this->articlePolicyMiddleware($id);

        // handle ... 数据过滤
        $payload = (int)$id;

        // handle
        (new ArticleRepository())->delete($payload); // should be true

        // 相当于 perform
        header("Location: ./index.php?theme=articles&action=index&controller=ArticleController");
        exit();
    }

    private function authMiddleware() {
        $this->state['credential'] = (new SessionedStateService())->getState();

        if ($this->state['credential']['isLoggedIn'] === false) {
            header("Location: ./index.php?action=login&controller=SessionController");
            exit();
        }
    }

    private function articlePolicyMiddleware($id) {
        $credentialUserId = (new SessionedStateService())->getState()['user_id'];
        $articleUserId = (new ArticleRepository())->getById((int)$id)['user_id'];
        $this->state['authorization'] = (new ArticlePolicyService())->getPermission($credentialUserId, $articleUserId);

        if ($this->state['authorization'] === false) {
            http_response_code(403);
            die('<b>403 Forbidden</b>');
        }
    }
    private function articlePolicyHelper(&$articles) {
        // set 'can' field for each article entity in $articles
        $credentialUserId = (new SessionedStateService())->getState()['user_id'];
        array_walk($articles, function(&$v, $k) use ($credentialUserId) {
            $v['can'] = false;
            $articleUserId = $v['user_id'];
            $v['can'] = (new ArticlePolicyService())->getPermission($credentialUserId, $articleUserId);
        });
    }
}
