<?php
namespace ResqueCommand\Commands;

use ResqueCommand\Commands\WorkerBaseCommand;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerStartCommand extends WorkerBaseCommand
{
    protected function configure()
    {
       parent::configure();        
       $this
            ->setName('worker:start')
            ->setDescription('start a single worker process ')
            ->setDefinition(array(

                new InputOption('app_include', "app_include|-a|--app", 
							InputOption::VALUE_OPTIONAL, 'a comma separated list of php files to be include', ''),
							
                new InputOption('redis_server', "redis_server|-r|--redis_server", 
							InputOption::VALUE_OPTIONAL, 'The host id for the redis server ip:port', '127.0.0.1:6379'),
                
				new InputOption('redis_index', "redis_index|-x|--redis_index", InputOption::VALUE_OPTIONAL, 'database index to use for redis', '9'),
                new InputOption('logging', "logging|-l|--logging", InputOption::VALUE_OPTIONAL, 'is loggin on', '0'),
                new InputOption('queue', "queue|-u|--queue", InputOption::VALUE_OPTIONAL, ' queue name', ''),
                new InputOption('interval', "interval|-i|--interval", InputOption::VALUE_OPTIONAL, ' queue name', ''),
                new InputOption('blocking', "blocking|-b|--blocking", InputOption::VALUE_OPTIONAL, ' is blocking set', true),
			))
            ->setHelp("<info>%command.name%</info> command starts a single php-resque worker process.");
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
		$args = [
			'app_include' => ($app_include = $input->getOption('app_include')),
	        'redis_server' => ( $redis_server = $input->getOption('redis_server')),
	        'redis_index' => ( $redis_index = $input->getOption('redis_index')),
	        'logging' => ($logging =  $input->hasOption('logging')),
	        'queue' => ( $queue = $input->getOption('queue')),
	        'interval' => ( $interval = $input->getOption('interval')),
	        'blocking' => ( $blocking = $input->hasOption('blocking')),
		];

		$output->writeln(print_r($args, true));

		\ResqueCommand\ResqueWrapper::startWorker(
			$app_include,
			$redis_server,
			$redis_index,
			$logging,
			$queue,
			$interval,
			$blocking
		);

    }    	

}