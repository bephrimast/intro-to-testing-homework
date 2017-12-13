<?php

class ProfitCalculator
{
    /**
     * Calculate if customer bought euros 7 days ago, would they be earning money or not.
     */
    public function calculate($amount)
    {
        $currencyExchangeApi = new CurrencyExchangeApi(
            new \GuzzleHttp\Client(),
            'http://hnbex.eu/api/v1/rates/daily/'
        );

        $euroSevenDaysAgo = $currencyExchangeApi->getRatesByDay('-7 days');
        $euroNow = $currencyExchangeApi->getRatesByDay('now');

        //@todo
    }
}