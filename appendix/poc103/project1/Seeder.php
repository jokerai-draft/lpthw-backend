<?php

class Seeder
{
    public function seeding() {
        $arr = [];
        $arr[] = ['id' => 0, 'username' => 'alice', 'password' => 'alice123'];
        $arr[] = ['id' => 1, 'username' => 'bill', 'password' => 'bill123'];
        $arr[] = ['id' => 2, 'username' => 'cindy', 'password' => 'cindy123'];
        $arr[] = ['id' => 3, 'username' => 'dave', 'password' => 'dave123'];

        $s = serialize($arr);
        file_put_contents('loginMap', $s);
        return $arr;
    }
}
$s = new Seeder();
$source = $s->seeding();

$payload = ['username' => 'dave', 'password' => 'dave123'];
$matched = array_filter($source, function($row) use ($payload) {
    if ($row['username'] === $payload['username'] && $row['password'] === $payload['password']){
        return $row;
    }
});


if ($count = count($matched) > 0){
    var_export("found $count ");
    var_export("it is " . gettype($matched) . "\n\n");
    var_export($matched);
}
$r = [];
$r['username'] = $matched[array_key_last($matched)]['username'];
$auth['user_id'] = $matched[array_key_last($matched)]['id'];
var_export($r);
