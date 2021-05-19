<?php

namespace Tarandro\Service;

use GuzzleHttp\Client;
use Symfony\Component\Filesystem\Filesystem;
use Tarandro\Contract\CurrencyInterface;
use Tarandro\Contract\CurrencyResourceInterface;
use Tarandro\Exception\CurrencyNotFoundException;
use Tarandro\Exception\InvalidContentException;
use Tarandro\Exception\InvalidDateException;

class Cbr implements CurrencyResourceInterface
{
    public const URL = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function __construct(
        protected Filesystem $filesystem,
        protected string $cacheDir,
    ) { }

    public function fetch(string $code, \DateTime $date): array
    {
        if ($date > new \DateTime()) {
            throw (new InvalidDateException())->setDate($date);
        }
        if (!$this->isCachedDate($date)) {
            $this->loadForDate($date);
        }
        if ($code !== CurrencyInterface::DEFAULT_CURRENCY) {
            $rate = $this->getRate($code, $date);
        }

        return ['rate' => $rate ?? 1, 'code' => $code, 'date' => $date];
    }

    protected function loadForDate(\DateTime $date)
    {
        $client = new Client(['base_uri' => static::URL]);
        $response = $client->get('', ['query' => ['date_req' => $date->format('d/m/Y')]]);

        $xml = simplexml_load_string($response->getBody()) ?: throw new InvalidContentException('Cannot parse data');
        if (!$xml->children()) {
            throw new InvalidContentException('Empty response');
        }

        $this->filesystem->mkdir($this->getDbDir($date));
        foreach ($xml->children() as $currency) {
            try {
                $value = (float )str_replace(',', '.', $currency->Value);
                $nominal = (float) str_replace(',', '.', $currency->Nominal);
                $this->filesystem->dumpFile($this->getCurrencyDir($currency->CharCode, $date), $value / $nominal);
            } catch (\Throwable) {
                continue;
            }
        }
    }

    protected function isCachedDate(\DateTime $date): bool
    {
        return $this->filesystem->exists($this->getDbDir($date));
    }

    protected function getRate($code, $date): float
    {
        return (float) @file_get_contents($this->getCurrencyDir($code, $date)) ?: throw (new CurrencyNotFoundException())->setCurrencyCode($code);
    }

    protected function getDbDir($date): string
    {
        return sprintf('%s/%s', $this->cacheDir, $date->format('Y-m-d'));
    }

    protected function getCurrencyDir($code, $date)
    {
        return sprintf('%s/%s.txt', $this->getDbDir($date), strtolower($code));
    }
}
