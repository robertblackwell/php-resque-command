#!/bin/sh

../build/resque_cmd.phar worker:start \
	--app_include="./include.php" \
	--redis_server="127.0.0.1:6379" \
	-x "9" \
	--logging \
	--queue="queue" \
	--interval=6