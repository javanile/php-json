<?php

require_once __DIR__.'/../functions.php';

class TestClass
{
    public $field1 = 10;
    public $field2 = 20;
    public $field3 = null;

    public function __construct()
    {
        $this->field3 = file_get_contents('tests/fixtures/corrupted.html');
    }
}

$object = [
    'a' => file_get_contents('tests/fixtures/corrupted.html'),
    'b' => new TestClass(),
];
$json = json_safe_encode($object)."\n";

file_put_contents('test.json', $json);
