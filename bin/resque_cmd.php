#!/usr/bin/env php
<?php
/**
 * This is the bootstrap file for resque_cmd.php, the non phar version of the command
 * It has to sort out "where it is running" so as to pull in the correct autoload.php
 */
if(file_exists(__DIR__.'/../vendor/autoload.php'))
{
	$root = realpath(__DIR__."/..");
}
else if(file_exists(__DIR__.'/../../../autoload.php'))
{
	$root = realpath(__DIR__."/../../../..");
}
else
{
    fwrite(STDERR,
        'You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL
    );
    exit(1);
}
$binDir = $root."/bin";
$srcDir = realpath(__DIR__."/../src");
$vendorDir = $root."/vendor";
// print "root: $root \n";
// print "binDir : $binDir\n";
// print "vendorDir : $vendorDir\n";
// print "srcDir : $srcDir\n";

require_once $vendorDir."/autoload.php";
// print "loaded autoload\n";
require_once "$srcDir/non_phar_main.php";