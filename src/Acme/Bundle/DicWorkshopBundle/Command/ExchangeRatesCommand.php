<?php

namespace Acme\Bundle\DicWorkshopBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Acme\Bundle\DicWorkshopBundle\Ecb\ExchangeRates;
use Acme\Bundle\DicWorkshopBundle\Parser\XmlParser;
use Acme\Bundle\DicWorkshopBundle\Adapter\MockAdapter;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class ExchangeRatesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ecb:exchangerates')
            ->setDefinition(array(
                new InputArgument('currency', InputArgument::OPTIONAL, 'A currency code ')
            ))
            ->setDescription('Outputs current Euro exchange rates')
            ->setHelp('Outputs current Euro exchange rates')
        ;
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->getContainer()->get('acme_dic.rates')->getRates() as $currency => $rate) {
            $output->writeln(sprintf('<info>%s</info> %s', $currency, $rate));
        }
    }
}
