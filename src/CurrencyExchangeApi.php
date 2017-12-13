<?php

use GuzzleHttp\Client;

class CurrencyExchangeApi
{
    const RATE_BUYING = 'buying_rate';
    const RATE_MEDIAN = 'median_rate';
    const RATE_SELLING = 'selling_rate';

    /** @var Client */
    private $client;

    /** @var string */
    private $dailyRateEndpoint;

    /**
     * CurrencyExchangeApi constructor.
     *
     * @param Client $client
     * @param $dailyRateEndpoint
     */
    public function __construct(Client $client, $dailyRateEndpoint)
    {
        $this->client = $client;
        $this->dailyRateEndpoint = $dailyRateEndpoint;
    }

    /**
     * The live endpoint is: http://hnbex.eu/api/v1/rates/daily/?date=YYYY-MM-DD
     *
     * @param $dateString
     * @param string $rateType
     *
     * @return mixed
     *
     * @throws \RuntimeException
     * @throws \HttpResponseException
     */
    public function getRateByDay($dateString, $rateType = self::RATE_MEDIAN)
    {
        $date = new DateTime($dateString);
        $parameters = ['date' => $date->format('Y-m-d'),];

        /** @var \GuzzleHttp\Psr7\Response $response */
        $response = $this->client->get($this->dailyRateEndpoint, $parameters);

        if (200 !== $response->getStatusCode()) {
            throw new HttpResponseException('Api did not return a valid response.');
        }

        $contents = $response->getBody()->getContents();

        $rates = json_decode($contents, true);

        $euroDataSet = $this->findEuroDataset($rates);

        return $euroDataSet[$rateType];
    }

    /**
     * @param array $rates
     *
     * @return mixed
     */
    private function findEuroDataset(array $rates)
    {
        return array_reduce($rates, function($rate, $carry) {
            if ('EUR' === $rate['currency_code']) $carry = $rate;

            return $carry;
        });
    }
}
