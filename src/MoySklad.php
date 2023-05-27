<?php

declare(strict_types=1);

namespace Evgeek\Moysklad;

use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\ApiObjects\Builders\ApiObjectBuilder;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Formatters\WithMoySkladInterface;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSenderFactory;
use Evgeek\Moysklad\Http\RequestSenderFactoryInterface;
use Evgeek\Moysklad\Meta\MetaMaker;

class MoySklad
{
    private ApiClient $api;

    /**
     * @param array                         $credentials          ['login', 'password'] или ['token']
     * @param JsonFormatterInterface        $formatter            Класс, форматирующий ответ от API
     * @param RequestSenderFactoryInterface $requestSenderFactory Фабрика, создающая PSR-7 совместимый клиент
     */
    public function __construct(
        array $credentials,
        private readonly JsonFormatterInterface $formatter = new StdClassFormat(),
        RequestSenderFactoryInterface $requestSenderFactory = new GuzzleSenderFactory(),
    ) {
        if (is_a($this->formatter, WithMoySkladInterface::class)) {
            $this->formatter->setMoySklad($this);
        }

        $this->api = new ApiClient($credentials, $this->formatter, $requestSenderFactory->make());
    }

    /**
     * Конструктор запросов
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->get();
     * </code>
     */
    public function query(): Query
    {
        return new Query($this->api);
    }

    /**
     * Конструктор объектов API
     *
     * <code>
     * $product = $ms->object()
     *  ->single()
     *  ->product(['name' => 'cucumber'])
     *  ->create();
     * </code>
     */
    public function object(): ApiObjectBuilder
    {
        return new ApiObjectBuilder($this);
    }

    /**
     * Конструктор метаданных
     *
     * <code>
     * $employeeMeta = $ms->meta()
     *  ->employee('25cf41f2-b068-11ed-0a80-0e9700500d7e');
     * </code>
     */
    public function meta(): MetaMaker
    {
        return new MetaMaker($this->formatter);
    }

    /**
     * Возвращает текущий форматтер
     *
     * <code>
     * $product = Product::make($ms, ['name' => 'orange']);
     * $productAsString = $ms->getFormatter()->decode($product);
     * </code>
     */
    public function getFormatter(): JsonFormatterInterface
    {
        return $this->formatter;
    }

    public function getApiClient(): ApiClient
    {
        return $this->api;
    }
}
