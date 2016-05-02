<?php
namespace DevGuru\SmsTrafficApiBundle\Command;

use DevGuru\SmsTrafficApi\Sms\Sms;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

class SendCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('smstraffic:send')
            ->setDescription('Sends message to given phone number')
            ->addArgument('phone', InputArgument::REQUIRED, 'Phone(s). To send message to multiple numbers use "," as separator')
            ->addArgument('message', InputArgument::REQUIRED, 'SMS Message');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = null;
        if ($output->getVerbosity() >= $output::VERBOSITY_VERBOSE) {
            $logger = new Logger('smstraffic');
            $logger->pushHandler(new StreamHandler(STDOUT));
        }

        $client = $this->getContainer()->get('dev_guru_sms_traffic_api.client_factory')->create($logger);
        $sms = new Sms($input->getArgument('phone'), $input->getArgument('message'));

        $client->send($sms);
    }
}
