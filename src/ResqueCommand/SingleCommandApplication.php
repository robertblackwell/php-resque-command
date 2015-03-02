<?php 

/*
**  $application = new SingleCommandApplication(new GreetCommand());
**  $application->run();
*/

class SingleCommandApplication extends Application
{

    private $singleCommandName;

    public function __construct(Command $command, $name = 'Php Resque Command', $version = '1.01')
    {
        parent::__construct($name, $version);

        // Add the given command as single (publicly accessible) command.
        $this->add($command);
        $this->singleCommandName = $command->getName();
        $this->version =  "V1.01";

        // Override the Application's definition so that it does not
        // require a command name as first argument.
        $this->getDefinition()->setArguments();
    }

    protected function getCommandName(InputInterface $input)
    {
        return $this->singleCommandName;
    }
}