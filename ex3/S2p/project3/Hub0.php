<?php
class Hub0
{
    public static $state;

    public static function start() {
        Assembled1::init();
        Component1::init();

        Assembled1::perform();

        // simple content handler
        if () {
            $level1payload = [];
            Assembled1::performX1($level1payload); // 处理从 inbound 到 outbound
        }
        // protected content handler
        if () {
            // ?
            $level1payload = [$username, $password];
            Component1::update($level1payload);
            $isLoggedIn = Component1::state['isLoggedIn'];
            // ? END

            $isLoggedIn = false;
            $level1payload = ['isLoggedIn' => $isLoggedIn,];
            Assembled1::performX2($level1payload);


            // 以下作废
            Assembled1::tryLogin();
            Component1::update();//它会去调用 State1Service::updateState($payload);
            Assembled1::update();
            Assembled1::performGET();
        }

    }
}
