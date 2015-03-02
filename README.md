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

## Beware of PHP version/extensions ##

The resulting phar file can be executed as a command like any other binary/shell script by entering

	resque_cmd .....
	
as the phar contains the required 

	#!/usr/bin/php 
	
line. But alas this does not work as (my fork at least) requires the php extension for ``setproctitle()`` and that extension is not available (on my development systems)
at ``/usr/bin/php``.

If this is your situation also then you will need to enter:

	php resque_cmd ....