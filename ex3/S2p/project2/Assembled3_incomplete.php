<?php
class Assembled3 extends Assembled
{
    public static function perform() {
        self::fillDatabag(); // process before render
        self::process1(); // handle it
        self::outboundProcess1();
        // $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        // return self::view('view1.php', $map);

        // render view1
        echo "<h4>" . SessionedComponent1::$age . "</h4>";
    }

    protected static function fillDatabag() { // fillDatabag hooker
        // self::$databag['age'] = 13;
    }
    protected static function process1() {
        if (self::$httpMessageHandler['REQUEST_METHOD'] === "POST") {

            /*
            update state

            check state

            render
            */

            $username = self::$httpMessageHandler['POST']['username'];
            $password = self::$httpMessageHandler['POST']['password'];
            SessionedComponent3::init();
            SessionedComponent3::tryLogin($username, $password);
            // if (SessionedComponent3::$isLoggedIn === true) {

            // }
            // if (SessionedComponent3::$isLoggedIn === false) {

            // }
        }
    }
    protected static function outboundProcess1() {
        if (SessionedComponent3::$isLoggedIn === true) {
            $location = self::$httpMessageHandler['GET']['location'];
            header("Location: ./$location");
            exit();
        }
        if (SessionedComponent3::$isLoggedIn === false) {
            self::$databag['msg'] = "unmatched username and password";
            $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
            self::view('view.login.php', $map);
        }
    }

}

// 说明: HTTP 报文处理器 提出去 单独判断 POST 情况, 而且 渲染器有自己的 databag, 渲染器在被填入数据(类似 由上一层填入 payload 给它)之后可直接渲染, 类似 performOut
