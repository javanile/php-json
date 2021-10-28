<?php

require_once __DIR__.'/../functions.php';

$object = [
    'a' => file_get_contents('tests/fixtures/corrupted.html'),
];
$json = json_safe_encode($object)."\n";

print_r($json);

