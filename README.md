PHP Resque Worker as a CLI Command 
===========================================

## Overview ##

This is a simple wrapper for either

-	my simple fork [robertblackwell/php-resque](https://github/robertblackwell/php-resque) of php-resque, or
-	the original [chrisboulton/php-resque](https://github.com/chrisboulton/php-resque) 

that turns either into a Symfony style console command.


I did this because I want to run multiple instances of ```php-resque``` using ```supervisord```
and I found the original interface to ```php-resque``` based around environment variables
a bit difficult/clumsy to deal with (maybe thats my problem not php-resque's).

I got the inspiration for this idea from [https://github.com/mjphaynes/php-resque](https://github.com/mjphaynes/php-resque).

## Dependency ##
The ``composer.json`` file currently points at [robertblackwell/php-resque](https://github/robertblackwell/php-resque). It is a simple fork and edit to point it at the original php-rescue. 

If you use this repo to wrap [robertblackwell/php-resque](https://github/robertblackwell/php-resque) be aware that your php will need the __setproctitle__ extension. Thats why I forked the original php-rescue in the first place.

## The command ##

So far I have implemented a single command that starts a single Resque worker process.

	
	resque_cmd worker:start
	
It takes the following possible options:

-	__app_requires__ : a path to a php file that will be require_once by the command to include classes required to actually perform some jobs.

-	__redis_server__ : something like '127.0.0.1:6379'
-	__redis_index__ : the index number of the reds database to be used by this worker.
-	__queue__ : the name of the single queue to be serviced by the worker.
-	__logging__: a switch to enable console logging.
-	__interval__ : the polling interval in seconds
-	__blocking__: a switch to turn on blocking	

## Available as a PHAR ##

The command is available as a __phar__ file. It is created via make and is 
deposited in 

	 build/resque_cmd.phar`

## Installation ##

`make install` will deposit the phar file in ~/bin

## Beware of PHP version/extensions ##

The resulting phar file can be executed as a command like any other binary/shell script by entering

	resque_cmd.phar .....
	
as the phar contains the required 

	#!/usr/bin/env php 
	
line. So the correct php version/installation __should__ be found.

But beware you __may__ have to run it by entering

	php resque_cmd.phar ......

