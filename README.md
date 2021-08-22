# lpthw-backend

access point
What is socket in application layer?
A socket is one endpoint of a two-way communication link between two programs running on the network. A socket is bound to a port number so that the TCP layer can identify the application that data is destined to be sent to. ... Every TCP connection can be uniquely identified by its two endpoints.
https://docs.oracle.com/javase/tutorial/networking/sockets/definition.html

computer network access point application layer socket - Google Search

Once you place your computer on a network, it interacts with many other ... at several major interconnection points called Network Access Points (NAPs).
https://www.oreilly.com/library/view/tcpip-network-administration/0596002971/ch01.html

传输链的比喻
Data encapsulation
https://www.oreilly.com/library/view/tcpip-network-administration/0596002971/ch01.html
(本层做不完的，给出代理机制，让下一层去做)(甚至下一层还有自己的 driver 类似 , 不同对象可以有不同的存储点 而 driver 是可以共用的 -- 这是如果会发生一个 "有架构的下一层" 的之后, 被 其它 模块 所需求, 而发生的: 立刻共用此架构)(hint: 先找到可共用的部分, 可更换的部分 很可能是可共用的部分, 本砍掉大量重复代码的部分 很可能是可共用的部分)
may vary, largely, maybe over engineering

双向传输的比喻 *
A socket is one endpoint of a two-way communication link between two programs running on the network.
https://docs.oracle.com/javase/tutorial/networking/sockets/definition.html
(和接入点的交互 必然是引发双向传输, inbound 和 outbound, inbound group 和 outbound group)
                                                         ^may vary

巨型状态机的比喻
所有读写都在这一块内存里发生 按照预留出来的内存位置, 由不同的工人去填充数据。除了处理此状态机之外，一个工人还负责读写外部信息。每一个工人完成之后 交给下一个工人，最终得到了填满了的状态机 / 每一层工人完成之后 交给下一层工人，最终状态机没有错过任何一层的处理
(所有操作记录在案)
may vary, completely new model (侵入性较强) that requires "specialized visibility" 参考 Shared mutable state is the root of all evil (共享的可变状态是万恶之源) // 可以说是违反了单一职责原则 看你怎么说了, 如果是对象级的单一职责 那么会有很多个对象 but 如果是函数级的单一职责 那么一个函数就像一个小工厂(自己负责自己与外星人的交互) 整体是一个大工厂 依然完成了大工厂的单一职责
// 意义在于 指示标意义 再扁平的数据获取模式 也不会比巨型状态机更扁平了
// 从不扁平到扁平: component as consumer (component with state service), component with state, component without state, component's consumer (assembled with component), the top consumer (assembled without component), the specialized visibility block,
