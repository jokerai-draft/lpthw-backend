<?php
class Assembled1 extends Assembled
{
    public static function perform() {
        self::fillDatabag(); // process before render
        self::process1(); // handle it
        self::outboundProcess1();
        // $map = ['databag' => self::$databag, 'httpMessageHandler' => self::$httpMessageHandler, ];
        // return self::view('view1.php', $map);

        // render view1
        // echo "<h4>" . SessionedComponent1::$age . "</h4>";

        // render view2
        $age = SessionedComponent1::$age;
        $url = self::$httpMessageHandler['URL'];
        echo <<<EOT
<h4>$age</h4>
<form action="$url" method="POST">
    <label for="increment">Increment</label><br>
    <input type="text" id="increment" name="increment" value="1" /><br>
    <input type="hidden" name="submitted" value="1" />
    <input type="submit" value="submit" />
    <input type="button" value="clean" onclick="document.getElementById('increment').value='';" />
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
            SessionedComponent1::$age = unserialize(file_get_contents("storage")) ?? 0;
            $age = SessionedComponent1::$age+(int)self::$httpMessageHandler['POST']['increment'];
            $age = (int)$age;
            file_put_contents("storage", serialize($age));
        }
    }
    protected static function outboundProcess1() {
        SessionedComponent1::$age = unserialize(file_get_contents("storage")) ?? 0;
    }

}
