#!/usr/bin/php
<?php
Phar::mapPhar();

include "phar://resque_cmd.phar/src/Main.php";

__HALT_COMPILER();