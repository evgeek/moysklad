<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\ApiObjectHelper;
use Evgeek\Moysklad\Services\Url;
use UnexpectedValueException;

trait CrudObjectTrait
{
    /**
     * Загрузка сущности из Моего Склада.
     *
     * <code>
     * $product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
     *  ->get();
     * </code>
     *
     * @throws RequestException
     */
    public function get(): static
    {
        return $this->send(HttpMethod::GET);
    }

    /**
     * Создание сущности в Моём Складе.
     *
     * <code>
     * $product = Product::make($ms, ['name' => 'orange'])->create();
     *
     * //Или
     * $product = Product::make($ms);
     * $product->name = 'orange';
     * $product->create();
     * </code>
     *
     * @throws RequestException
     */
    public function create(): static
    {
        return $this->send(HttpMethod::POST);
    }

    /**
     * Обновление сущности.
     *
     * <code>
     * $product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
     * ->update(['name' => 'orange']);
     *
     * //Или
     * $product = Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621']);
     * $product->name = 'orange';
     * $product->update();
     * </code>
     *
     * @throws RequestException
     */
    public function update(mixed $content = []): static
    {
        $this->hydrateAdd($content);

        return $this->send(HttpMethod::PUT);
    }

    /**
     * Удаление сущности.
     *
     * <code>
     * Product::make($ms, ['id' => '9aa1b41b-f2fc-11ed-0a80-0f60007ec621'])
     *  ->delete();
     * </code>
     *
     * @throws RequestException
     */
    public function delete(): static
    {
        return $this->send(HttpMethod::DELETE);
    }

    /**
     * Универсальный метод, позволяющий отправлять произвольный HTTP-запрос.
     *
     * <code>
     * $product = Product::make($ms, ['id' => '825c1a20-f2ff-11ed-0a80-0868007fddf4']);
     * $product->name = 'tangerine';
     * $product->send('PUT');
     * </code>
     *
     * @throws RequestException
     */
    public function send(HttpMethod|string $method): static
    {
        $payload = $this->makePayload(HttpMethod::makeFrom($method));

        $response = $this->ms->getApiClient()->send($payload);
        if (ApiObjectHelper::isCollection($this->ms, $response)) {
            throw new UnexpectedValueException('Response must be an object, collection received');
        }

        $this->hydrate($response);

        return $this;
    }

    protected function makePayload(HttpMethod $method): Payload
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $this,
        );
    }
}
