<?php

namespace Tarandro\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tarandro\Contract\CurrencyInterface;
use Tarandro\Exception\CurrencyNotFoundException;
use Tarandro\Exception\InvalidDateException;
use Tarandro\Repository\RateRepository;

class CurrencyRate extends Command
{
    public const DEFAULT_CURRENCY = 'USD';

    public const OPTION_DATE = 'date';

    public const OPTION_FROM_CURRENCY = 'from';

    public const OPTION_TO_CURRENCY = 'to';

    protected static $defaultName = 'fetch-currency';

    public function __construct(
        protected RateRepository $rateRepository,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Fetch currency rates from CBR')
            ->addOption(self::OPTION_DATE, 'd', InputArgument::OPTIONAL, 'ISO Date', date('Y-m-d'))
            ->addOption(self::OPTION_FROM_CURRENCY, 'f', InputArgument::OPTIONAL, 'From currency', CurrencyInterface::BASE_CURRENCY)
            ->addArgument(self::OPTION_TO_CURRENCY, InputArgument::OPTIONAL, 'To currency', static::DEFAULT_CURRENCY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fromCurrency = $input->getOption(self::OPTION_FROM_CURRENCY);
        $toCurrency = $input->getArgument(self::OPTION_TO_CURRENCY);
        try {
            $date = new \DateTime($input->getOption(self::OPTION_DATE));
        } catch (\Throwable) {
            $output->writeln("<error>Failed to parse date: {$input->getOption(self::OPTION_DATE)}</error>");
            return Command::FAILURE;
        }

        try {
            $rate = $this->rateRepository->get($fromCurrency, $toCurrency, $date);

            $em = $rate->getDelta() >= 0 ? '<info>+%.4f</info>' : '<error>%.4f</error>';
            $output->writeln("Currency rate on <comment>{$rate->getDate()->format('d.m.Y')}</comment>");
            $output->writeln(sprintf("%s -> %s: %.4f $em", strtoupper($rate->getBaseCurrency()), strtoupper($rate->getTargetCurrency()), $rate->getRate(), $rate->getDelta()));
            return Command::SUCCESS;
        } catch (CurrencyNotFoundException $e) {
            $output->writeln("<error>Currency {$e->getCurrencyCode()} is not found</error>");
        } catch (InvalidDateException $e) {
            $output->writeln("<error>Cannot fetch data for specified date: {$e->getDate()->format('d.m.Y')}</error>");
        } catch (\Throwable $e) {
            $output->writeln("<error>Cannot fetch currency rate: {$e->getMessage()}</error>");
        }
        return Command::FAILURE;
    }
}
