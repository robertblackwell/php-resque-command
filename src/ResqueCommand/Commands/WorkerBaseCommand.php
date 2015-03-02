<?php
namespace ResqueCommand\Commands;

use ResqueCommand\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WorkerBaseCommand extends Command
{

     protected function configure()
    {
        $this->common_help_text =<<<EOF
Controls <info>php-resque</info> worker processes

EOF;
        $this->shared_definition =  array();
    }

}