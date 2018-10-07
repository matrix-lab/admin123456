<?php

$table = new swoole_table(1024);
$table->column('fd', swoole_table::TYPE_INT);
$table->column('from_id', swoole_table::TYPE_INT);
$table->create();

$server        = new swoole_websocket_server('127.0.0.1', 8090);
$server->table = $table;

$server->on('open', function (swoole_websocket_server $_server, $request) {
    $client = $_server->table->get($request->fd);
    if (!$client) {
        $_server->table->set($request->fd, ['fd' => $request->fd, 'data' => null]);
        if ($_server->table->count()) {
            foreach ($_server->table as $client) {
                $_server->push($client['fd'], json_encode([
                    'message' => "客户端{$request->fd}上线了",
                    'count'   => $_server->table->count(),
                ]));
            }
        }
        echo "当前活跃用户为：{$_server->table->count()}人\n";
    }
});

$server->on('message', function (swoole_websocket_server $ser, $fm) {
    if ($ser->table->count()) {
        foreach ($ser->table as $client) {
            $ser->push($client['fd'], json_encode(['data' => $fm->data, 'count' => $ser->table->count()]));
        }
    }
});

$server->on('close', function ($ser, $fd) {
    $ser->table->del($fd);
    if ($ser->table->count()) {
        foreach ($ser->table as $client) {
            $ser->push($client['fd'], json_encode(['message' => "客户端{$fd}离开了", 'count' => $ser->table->count()]));
        }
    }
    echo "客户端 {$fd} 关闭\n";
});

$server->start();
