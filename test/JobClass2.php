<?php
	

class JobClass2
{
	function perform()
	{
		print __METHOD__."\n";
		print_r ($this->args);
		print __METHOD__."\n";

	}
}


?>