<?php
class Component1
{
    public static $state;
    public static function init() {
        self::$state = [];
        self::$state = array_merge(self::$state, State1Service::getState());
    }
    public static function onNotif() {
        self::$state = State1Service::getState();
    }
}

// 目前这个 Component (SessionedComponent) 没有任何渲染器方面的东西, 只有 state // 未来小概率可能会自带模板用于展示 state
// 很类似 state's store // 能把 state 管理清楚就不错了: state, side effect (把内存之中的东西 写入外部存储空间, 在 init component 的时候载入 state)
// 参考 https://ngrx.io/guide/effects 说明: 它是典型的 persistence layer problem
