<?php
class Hub1
{
    public static $state;

    public static function start() {
        Assembled1::init();
        Component1::init();



        // ...
        // 这里可以插入检查用户登入状态的 block , 若不满足登入要求 则直接进入 收尾 block



        // simple content handler
        if (false) {
            Component1::onNotif();
            self::$state = Component1::$state; // 关键值的获取(此两行)

            $level1payload = [];
            $level1payload = self::$state; // Assembled1 并不知道 state's component 的存在
            Assembled1::performIn($level1payload);
            Assembled1::performOut(); // 处理从 inbound 到 outbound
        }




        // simple content handler, get and post
        if (true) {
            $method = Assembled1::$httpMessageHandler['REQUEST_METHOD'];

            // 预处理
            if ($method === "GET") {
                Component1::onNotif();
                self::$state = Component1::$state; // 关键值的获取(此两行)
            }

            if ($method === "POST") {
                $payload = (int)Assembled1::$httpMessageHandler['POST']['step'];
                if (Assembled1::$httpMessageHandler['POST']['submit'] === "+") {
                    State1Service::increment($payload); // 要直接修改文件的 service 并不知道 state's component 的存在
                }
                if (Assembled1::$httpMessageHandler['POST']['submit'] === "-") {
                    State1Service::decrement($payload);
                }
                Component1::onNotif();
                self::$state = Component1::$state; // 关键值的获取(此两行)
            }





            $level1payload = [];
            $level1payload = self::$state; // Assembled1 并不知道 state's component 的存在
            Assembled1::performIn($level1payload);
            Assembled1::performOut(); // 处理从 inbound 到 outbound

            // 以上四句是收尾, 很可能会被拿出去 自成 block , 叫做 收尾 block
            // 其实是 *激活渲染单位*  (渲染器在被填入数据(类似 由上一层填入 payload 给它)之后可直接渲染)
        }

    }
}

/*
参考
完全不管如何 render 也不知道 view.php 的存在, 这一点很像 model
// 故而 performOut() 是非常有必要的

参考
直接接管 POST 请求, 这一点很像 "一个 HTTP 报文处理器的实例", 实际上就是 一个 HTTP 报文处理器的实例 完成的
                          很像 一个 HTTP 报文处理器的实例, 很像 document1 入口
// 故而 HTTP 报文处理器 是非常有必要的

*/
/*
参考
直接抓取数据给 渲染决定器 送去, 这一点很像 model // 之前的 assembled 自带了渲染决定器
// 故而 performOut() 是非常有必要的

参考
直接把 payload 交给 service, 这一点很像 service 的消费者  // 之前的 sessionedcomponent
// 故而 State1Service.php 是非常有必要的

*/



// 目前的 Hub 是一个真实启动器 更好的载入页启动器 (载入式启动器)

// 就状态管理而言, 目前感觉状态管理线还是很清晰的 可以适应大规模状态管理 (新的数据 新的数据固化地点?   可以直接上 storage2 + State2Service, 依然放在 Component1 里)( Component1 依然不用接管 view , 已经有 performOut() 接管 VO )

// (即使是大面积密集处理 搜索结果, 也可直接在一个 Hub 里用 一个 service 解决返回值、一个 HTTP 报文处理器解决 GET 参数, 总结出 payload 直接给到 service )
