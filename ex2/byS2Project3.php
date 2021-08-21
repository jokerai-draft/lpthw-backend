
可能影响载入页的因素

根据 "sealed 组合 view 是谁在做, 谁在负责判断显式哪个 view" 的不同, 会影响载入页的载入速度

在载入式启动器完成 POST 处理(但没有更多的 state 状态管理, component's state, service 为 state 提供算力)的基础上:
// 最终的确是让载入页去渲染 object 里的数据
// service 是最高层, state's component 是高层, state 值是高层来的, 载入式启动器是低层; 载入式启动器负责何时去获取最新值
// 结果是什么? 可以获得一个变量; 结果是什么? 渲染决定器可以根据这个变量决定渲染什么(渲染哪个view)(让view自己去根据object选择怎么渲染); 结果是什么? 载入式启动器不受影响地处理表格; 结果是什么? 把 inbound 的路子和 outbound 的路子分开, 表格处理仅仅需要 inbound 路子即可, 决定返回什么(渲染哪个view OR 返回 JSON) 是 outbound 路子决定的, 可以组合半天 (any component, any state, the predefined state)(by any state computation service) 组合出一个字符串来 交给 "HTTP 报文处理器"

| feature: 暂时不需要 ORM 但在 service 里做完了数据库操作; service 还可以专门为了查找某个数据(某个数据表,某个数据表及其 say 一对多关系的 关联数据表)做一个某模型的仓库模式

| feature: 暂时不需要 middleware 但在 "HTTP 报文处理器" 完成了形式上的传入处理和传出处理, 其中 传入处理主动包括了对 session 的读取, 传出处理主动包括了对 session 的读取和写入; 它还可以专门为 某一块文件的读写 完成一条线路 (支持IO阻塞,让IO在此线路阻塞,让此线路的处理结果 作为一个重大结果 被下一条线路读取)

| feature: 暂时不需要状态分组的状态管理, 但有专门的一个 component 管理某个变量, 一个专门的 state's component 管理某个 crucial state ; 在其它东西看来 它本身变成了一个 service , 那么这块的 API 可以好好设计

| feature: 支持基本的 record 读写, 有专门的 component 在管理; 此 component 可以有专门自己的杂七杂八的 state 返回来, 能直接在(渲染哪个view)view里渲染到

| feature: 没有支持 mvc , 很多东西写死在 component 里了; 如果想更换 直接换 component 就可以了 (最终的 content consumer 是 view, 最终的 content provider 是 component)(handler 决定了渲染哪个view, )(handler 决定了传入线路处理组, 得到了一个结果组, 根据这个结果组, 去决定 传出线路处理组, 得到了一个字符串去渲染哪个view 或 拾取到了各部分返回值组成的一个结果组 去渲染哪个view OR 返回JSON)

#### 未来方向
可以在展示的时候, 已登入的展示什么、未登入的展示什么 // view1.php
可以在 process 里作读写验证 (配置登入) // 读到验证文件和用户输入匹配了, 就把 session['isLoggedIn'] 设为 true

按照 如何处理 state 的角度
可以把这个 state 交给一个 service 去处理, 返回值交给 state's component

如果是一个 component 那么必然有它的展示周期 (获取最新值 then 展示), 在这种情况下, 应该直接给 "负责整体展示的对象" 返回值, 也就是说 component 是 "载入式启动器" 的一个对象:
- 载入式启动器 有(安排) component 的 激活机会
- component 自己管理自己的 state
- component 自己管理自己所需 service (读写硬盘, tryLogin 尝试登入)
- 在按钮之后, 载入式启动器 负责表格处理并展示结果; 载入式启动器负责拾取各部分html并展示结果;
- 在获得值之后, component 负责调用 service 返回 state 最新值, 打包好之后 返回给载入式启动器 sealed
- 在得到数据之后, 载入式启动器解绑 sealed 并填入模板; 载入式启动器 甚至可以 根据 sealed 选择不同的载入模板 // layout system 达成
- component 不关心模板, 只关心自己的 sealed 的, 里面是纯字符串
- 载入式启动器 负责模板的判断, 但可以 1 自己负责 2 根据 component 返回的 sealed 自己负责 3 交给 component 负责
———————— 这些又是可能影响载入页的因素了!!!!!!!!!!!!!!!!!!!


参考
(pyzSlimAStestlayeredphp.zip) pyzSlim/Downloads/demo3/pyzSlim
find . -type f -name "*Plate*"
find . -type f -name "*Component*"
