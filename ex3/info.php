
应用的不同等级



https://www.php.net/manual/zh/language.variables.superglobals.php
https://stackoverflow.com/questions/6768793/get-the-full-url-in-php
https://stackoverflow.com/questions/3737139/reference-what-does-this-symbol-mean-in-php

$_SERVER['REQUEST_URI'] because, it will only be available on an apache server.
https://stackoverflow.com/questions/24726223/serverrequest-uri-is-it-secure
https://stackoverflow.com/questions/4730798/what-is-the-difference-between-serverrequest-uri-and-getq
https://www.webadminblog.com/index.php/2010/02/23/a-xss-vulnerability-in-almost-every-php-form-ive-ever-written/

https://stackoverflow.com/questions/8641889/how-to-use-php-serialize-and-unserialize 固化层

https://www.runoob.com/php/php-sessions.html
https://tutorials.supunkavinda.blog/php/superglobals
 (other guide like book as Lumen Programming Guide https://laravel-news.com/orbit-flat-file-eloquent )

组合
组合 https://www.bookstack.cn/read/LearnPython3TheHardWay/spilt.49.learn-py3.md
构造函数里传入一个对象
https://tutorials.supunkavinda.blog/php/oop-constructor-destructor
https://www.v2ex.com/t/543746#MySqlAdapter mysql adapter 强烈的组合意味
https://www.ruanyifeng.com/blog/2021/06/drunk-post-of-a-programmer.html
https://www.php.net/manual/zh/language.oop5.decon.php#language.oop5.decon.constructor.static

https://designpatternsphp.readthedocs.io/en/latest/Creational/Singleton/README.html

print_r(var_export($_SESSION['isLoggedIn'], true)); // 字符串 true 或 false

类变量和单例模式的区别
如果出于某种原因您不需要一个对象的多个副本，那么与静态对象相比，单例设计模式具有优势，例如线程安全(假定您的单例代码编写得很好)、允许延迟初始化、确保对象在使用时已正确初始化、子类化、测试和重构方面的优势
最好在第一次设置"正确"的东西，即使它看起来有缺点
https://www.codenong.com/7026507/
静态变量有两个主要问题：
    线程安全-静态资源的定义不是线程安全的
    代码含义-您不知道静态变量何时被实例化，以及它是否将在另一个静态变量之前被实例化
