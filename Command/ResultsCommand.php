<?php

namespace Kumite\KumiteBundle\Command;

use Kumite\Test;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResultsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('kumite:results');
        $this->setDescription('Print the results of a kumite experiment');
        $this->addArgument('test', InputArgument::REQUIRED, 'Test identifier');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // TODO make this work
        $test = $this->getTest($input->getArgument('test'));
        $results = $test->results();
        $control = $test->getDefault()->key();

        foreach ($results->events() as $event) {

            $output->writeln("Event [$event]");

            $table = new Table($output);
            $table->setHeaders(['Variation', 'Visitors', 'Conversions', 'Conversion Rate', 'Improvement', 'Chance to beat']);
            foreach ($results->variants() as $variant) {

                if ($results->variantTotal($variant) == 0) {
                    continue;
                }

                $table->addRow([
                    $variant,
                    $results->variantTotal($variant),
                    $results->eventTotal($variant, $event),
                    $results->conversionRate($variant, $event),
                    $results->changePercent($variant, $event, $control),
                    $results->significance($variant, $event, $control), // needs php stats extension
                ]);
            }
        }
    }

    /**
     * @return Test
     */
    private function getTest($testKey)
    {
        return $this->getContainer()->get('kumite')->getTest($testKey);
    }
}
