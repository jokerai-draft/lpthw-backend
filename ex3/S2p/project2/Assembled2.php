<?php
class Assembled2 extends Assembled
{
    public static function perform() {
        self::fillDatabag(); // process before render
        self::processLoginCheck();
        self::process1(); // handle it
        self::outboundProcess1();
        // $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        // return self::view('view1.php', $map);

        // render view1
        // echo "<h4>" . SessionedComponent1::$age . "</h4>";

        // render view2
        $counter = SessionedComponent2::$counter;
        $step = SessionedComponent2::$step;
        $url = self::$httpMessageHandler['URL'];
        echo <<<EOT
<form action="$url" method="POST">
    <input type="submit" name="submit" value="+" />
    <span>$counter</span>
    <input type="submit" name="submit" value="-" /><br>
    <label for="step">step </label>
    <input type="text" id="step" name="step" value="$step" /><br>
    <input type="hidden" name="submitted" value="1" />
    <input type="button" value="clean" onclick="document.getElementById('step').value='';" />
</form>
EOT;
    }

    protected static function fillDatabag() { // fillDatabag hooker
        // self::$databag['age'] = 13;
    }
    protected static function process1() {
        // version1
        // SessionedComponent1::$age = 12;

        // version2
        if (self::$httpMessageHandler['REQUEST_METHOD'] === "POST") {
            $content = unserialize(file_get_contents("storage2"));
            SessionedComponent2::$counter = $content['counter'] ?? 0;
            SessionedComponent2::$step = $content['step'] ?? 1;
            if (self::$httpMessageHandler['POST']['submit'] === "+") {
                $counter = SessionedComponent2::$counter+(int)self::$httpMessageHandler['POST']['step'];
            } else if (self::$httpMessageHandler['POST']['submit'] === "-") {
                $counter = SessionedComponent2::$counter-(int)self::$httpMessageHandler['POST']['step'];
            }
            $content = ['counter' => (int)$counter, 'step' => (int)self::$httpMessageHandler['POST']['step']];
            file_put_contents("storage2", serialize($content));
        }
    }
    protected static function outboundProcess1() {
        // SessionedComponent2::$counter = unserialize(file_get_contents("storage2")) ?? 0;
        $content = unserialize(file_get_contents("storage2"));
        SessionedComponent2::$counter = $content['counter'] ?? 0;
        SessionedComponent2::$step = $content['step'] ?? 1;

        // deciding
        // if (SessionedComponent3::$isLoggedIn !== true) {
        //     return self::view('login.php');
        // }
        // if (SessionedComponent3::$isLoggedIn === true) {
        //     return self::view('...');
        // }
    }

    protected static function processLoginCheck() {
        SessionedComponent3::init();
        if (SessionedComponent3::$isLoggedIn !== true) {
            // SessionedComponent3::tryLogin(); // bypass
            // echo "please login";
            // better to redirct to "document.login.php/login.php" as it renders view('view.login.php'); // to trigger tryLogin()
            // exit();
            header("Location: ./document.login.php?location=document2.php");
            exit();
        }
        if (SessionedComponent3::$isLoggedIn === true) {
            // SessionedComponent3::logout();
        }
    }
}
