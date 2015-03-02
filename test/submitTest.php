<?php
require_once __DIR__."/../vendor/autoload.php";

\Resque::setBackend("127.0.0.1:6379", 9);

\Resque::enqueue("queue", "\\JobClass1", ['parm1' => 'This is one', 'parm2'=>'this is 2','who' => 'JobClasss1']);
\Resque::enqueue("queue", "\\JobClass2", ['parm1' => 'This is one', 'parm2'=>'this is 2', 'who' => 'JobClass2']);

?>