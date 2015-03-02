<?php
namespace ResqueCommand;
	
class ResqueWrapper
{
	static function startWorker(
		    $app_requires, // array of files to require
		    $redisServer,   // in the form "127.0.0.1:9367
		    $redisDatabase, // database index eg, 9
		    $queue,         // string
		    $logLevel=false, //turns on/off INFO DEBUG messages only - more important are always ON
		    $interval=5,
		    $blocking=true
		)
		{
			if( is_string($app_requires)) $app_requires = [$app_requires];
			
			if( is_array($app_requires) ){
			    foreach($app_requires as $file) {
			        if( ! file_exists($file) ){
			            throw new \InvalidArgumentException(" startWorker require file $ $file does not exist ");
			        }
			        require_once $file;
			    }
			}
		    $logger = new \Resque_Log($logLevel);

		    \Resque::setBackend($redisServer, $redisDatabase);

		    $worker = new \Resque_Worker([$queue]);
		    $worker->setLogger($logger);

		    $logger->log(\Psr\Log\LogLevel::NOTICE, 'Starting worker {worker}', array('worker' => $worker));
		    $worker->work($interval, $blocking);
		}
}	
	
	
?>