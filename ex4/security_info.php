
security info

$_SERVER['PHP_SELF'] 和 XSS
https://stackoverflow.com/questions/6080022/php-self-and-xss

cache 的第一种思路:
如果有 cache 那么必然要考虑 cache 与某个数据源的同步问题
"只读取 cache 而不读取最新信息 是非常容易做到的"
何时去读取最新信息(标记cache过期) 是一个可以引发 'cache 自刷新' 的条件
何时标记cache过期是单独的逻辑, 何时读取'标记cache过期'的变量 是单独的逻辑 // 比如 读到 isCacheOutdated为false 就 loadStateFromCache 否则 就 loadStateFromFile 。最终可能会形成一个环扣, 正好把 saveStateToFile/loadStateFromFile 拦截住 (仅在读cache周期)(在状态更新周期是不可能被拦住的,而且还要主动制造 isCacheOutdated为true 的 event , 供 "loadState" 无限访问)

cache 的第二种思路:
最新数据应该仅仅在 event 之后产生
最新数据应该仅仅在 event 之后产生, 在新 event 之后才可能会 (将新数据吐出和老数据吐出放在一起看) 看出 defect 的产生
那么只要保持每次 event 每次吐数据就 OK 了 --- 不用 看 isCacheOutdated为true , event handle 就直接更新 内存数据 了
参考 ex3/S2d/project13/defect.txt
