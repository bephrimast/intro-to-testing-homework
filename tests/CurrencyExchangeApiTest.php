<?php

namespace Tests;

use CurrencyExchangeApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class CurrencyExchangeApiTest extends TestCase
{
    /** @var CurrencyExchangeApi */
    private $currencyExchangeApi;

    /** @var Mock */
    private $client;

    /** @var Mock */
    private $response;

    /** @var Mock */
    private $body;

    /** @var string */
    private $endpoint;

    public function setUp()
    {
        $this->client = \Mockery::mock(Client::class);
        $this->response = \Mockery::mock(Response::class);
        $this->body = \Mockery::mock(StreamInterface::class);
        $this->endpoint = 'http://fake.hnbex.eu/api/v1/rates/daily/';

        $this->currencyExchangeApi = new CurrencyExchangeApi($this->client, $this->endpoint);
    }

    public function testItCanBeConstructed()
    {
        self::assertInstanceOf(CurrencyExchangeApi::class, $this->currencyExchangeApi);
    }

    /**
     * @dataProvider rateTypeInputProvider
     */
    public function testFakeApi($expectedRate, $dateString, $rateType)
    {
        $this->client->shouldReceive('get')
            ->withArgs([
                'http://fake.hnbex.eu/api/v1/rates/daily/', ['date' => $dateString]
            ])
            ->andReturn($this->response);

        $this->response->shouldReceive('getStatusCode')->andReturn(200);
        $this->response->shouldReceive('getBody')->andReturn($this->body);
        $this->body->shouldReceive('getContents')->andReturn($this->getResponseDataByDateString($dateString));
        
        $this->assertEquals($expectedRate, $this->currencyExchangeApi->getRateByDay($dateString, $rateType));
    }

    public function rateTypeInputProvider()
    {
        return [
            [7.523245, '2017-12-12', CurrencyExchangeApi::RATE_BUYING],
            [7.545883, '2017-12-12', CurrencyExchangeApi::RATE_MEDIAN],
            [7.568521, '2017-12-12', CurrencyExchangeApi::RATE_SELLING],
            [7.527079, '2017-12-07', CurrencyExchangeApi::RATE_BUYING],
            [7.549728, '2017-12-07', CurrencyExchangeApi::RATE_MEDIAN],
            [7.572377, '2017-12-07', CurrencyExchangeApi::RATE_SELLING],
        ];
    }


    public function getResponseDataByDateString($dateString)
    {
        return [
            '2017-12-12' =>
'[{"median_rate": "4.817341", "currency_code": "AUD", "selling_rate": "4.831793", "buying_rate": "4.802889", "unit_value": 1}, {"median_rate": "4.977495", "currency_code": "CAD", "selling_rate": "4.992427", "buying_rate": "4.962563", "unit_value": 1}, {"median_rate": "0.294807", "currency_code": "CZK", "selling_rate": "0.295691", "buying_rate": "0.293923", "unit_value": 1}, {"median_rate": "1.013768", "currency_code": "DKK", "selling_rate": "1.016809", "buying_rate": "1.010727", "unit_value": 1}, {"median_rate": "2.400777", "currency_code": "HUF", "selling_rate": "2.407979", "buying_rate": "2.393575", "unit_value": 100}, {"median_rate": "5.641360", "currency_code": "JPY", "selling_rate": "5.658284", "buying_rate": "5.624436", "unit_value": 100}, {"median_rate": "0.763676", "currency_code": "NOK", "selling_rate": "0.765967", "buying_rate": "0.761385", "unit_value": 1}, {"median_rate": "0.753308", "currency_code": "SEK", "selling_rate": "0.755568", "buying_rate": "0.751048", "unit_value": 1}, {"median_rate": "6.457199", "currency_code": "CHF", "selling_rate": "6.476571", "buying_rate": "6.437827", "unit_value": 1}, {"median_rate": "8.562218", "currency_code": "GBP", "selling_rate": "8.587905", "buying_rate": "8.536531", "unit_value": 1}, {"median_rate": "6.396985", "currency_code": "USD", "selling_rate": "6.416176", "buying_rate": "6.377794", "unit_value": 1}, {"median_rate": "7.545883", "currency_code": "EUR", "selling_rate": "7.568521", "buying_rate": "7.523245", "unit_value": 1}, {"median_rate": "1.795228", "currency_code": "PLN", "selling_rate": "1.800614", "buying_rate": "1.789842", "unit_value": 1}]',
            '2017-12-07' =>
'[{"median_rate": "4.843606", "selling_rate": "4.858137", "unit_value": 1, "buying_rate": "4.829075", "currency_code": "AUD"}, {"median_rate": "5.038190", "selling_rate": "5.053305", "unit_value": 1, "buying_rate": "5.023075", "currency_code": "CAD"}, {"median_rate": "0.293970", "selling_rate": "0.294852", "unit_value": 1, "buying_rate": "0.293088", "currency_code": "CZK"}, {"median_rate": "1.014489", "selling_rate": "1.017532", "unit_value": 1, "buying_rate": "1.011446", "currency_code": "DKK"}, {"median_rate": "2.401619", "selling_rate": "2.408824", "unit_value": 100, "buying_rate": "2.394414", "currency_code": "HUF"}, {"median_rate": "5.692752", "selling_rate": "5.709830", "unit_value": 100, "buying_rate": "5.675674", "currency_code": "JPY"}, {"median_rate": "0.771325", "selling_rate": "0.773639", "unit_value": 1, "buying_rate": "0.769011", "currency_code": "NOK"}, {"median_rate": "0.760234", "selling_rate": "0.762515", "unit_value": 1, "buying_rate": "0.757953", "currency_code": "SEK"}, {"median_rate": "6.458831", "selling_rate": "6.478207", "unit_value": 1, "buying_rate": "6.439455", "currency_code": "CHF"}, {"median_rate": "8.542349", "selling_rate": "8.567976", "unit_value": 1, "buying_rate": "8.516722", "currency_code": "GBP"}, {"median_rate": "6.386168", "selling_rate": "6.405327", "unit_value": 1, "buying_rate": "6.367009", "currency_code": "USD"}, {"median_rate": "7.549728", "selling_rate": "7.572377", "unit_value": 1, "buying_rate": "7.527079", "currency_code": "EUR"}, {"median_rate": "1.791540", "selling_rate": "1.796915", "unit_value": 1, "buying_rate": "1.786165", "currency_code": "PLN"}]'
        ][$dateString];

    }
}