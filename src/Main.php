#!/usr/bin/env php
<?php
// app/console
require_once dirname(dirname(__FILE__))."/vendor/autoload.php";
use ResqueCommand\Commands\WorkerStartCommand;

use Symfony\Component\Console\Application;

$application = new Application("Php Resque Command", "V2.0");
$application->add(new WorkerStartCommand);
$application->run();