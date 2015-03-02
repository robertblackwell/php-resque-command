#!/usr/local/bin/php 
<?php

$srcRoot = dirname(__FILE__)."/src";
$buildRoot = dirname(__FILE__)."/build";
$phar_file = "push.phar";
$target = $buildRoot."/".$phar_file;

print "Building $target with phar name of $phar_file\n";
  
$phar = new Phar(
	$target, 
    FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, 
    $phar_file
    );
$phar["main.php"] = file_get_contents($srcRoot . "/Main.php");
$phar["Synchronizer.php"] = file_get_contents($srcRoot . "/Synchronizer.php");
$phar["Commands/ConfigObject.php"] = file_get_contents($srcRoot . "/ConfigObject.php");

$list = glob($srcRoot.'/Commands/*.php');

foreach($list as $file){
	$bn = basename($file);
	$phar["Commands/".$bn] = file_get_contents($srcRoot . "/Commands/".$bn);
}

$phar->setStub(file_get_contents($srcRoot."/Stub.php"));

print "phar build complete\n";
