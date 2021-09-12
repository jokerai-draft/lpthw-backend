#
proof of concept (poc)

这里有一致性很高的一套工具集, 顺带展示了他们的用法
参考 ex5/g1/detection1
参考 ex3/S2p/project3/State1Service.php (counter)

route

assemble

controller

state service

请求处理流程:
request -> route -> controller -> response
组件关系:
state service <-> controller#action <- route
view <- controller#action <- route <- response <- controller#action and view

