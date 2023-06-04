<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\CollectionHelper;
use Evgeek\Moysklad\Services\RecordHelper;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

trait CrudCollectionTrait
{
    /**
     * Загрузка коллекции из Моего Склада.
     *
     * <code>
     * $products = Product::collection($ms)->get();
     * </code>
     *
     * @throws RequestException
     */
    public function get(): static
    {
        return $this->send(HttpMethod::GET);
    }

    /**
     * Загрузка следующей страницы коллекции. Если страницы не существует, вернёт null.
     *
     * <code>
     * $products = Product::collection($ms)->get();
     * $productNext = $product->getNext();
     * </code>
     *
     * @throws RequestException
     */
    public function getNext(): ?static
    {
        $nextHref = $this->meta->nextHref ?? null;

        if (!$nextHref) {
            return null;
        }

        $this->meta->href = $nextHref;

        return $this->send(HttpMethod::GET);
    }

    /**
     * Загрузка предыдущей страницы коллекции. Если страницы не существует, вернёт null.
     *
     * <code>
     * $products = Product::collection($ms)->get();
     * $productPrevious = $product->getPrevious();
     * </code>
     *
     * @throws RequestException
     */
    public function getPrevious(): ?static
    {
        $previousHref = $this->meta->previousHref ?? null;

        if (!$previousHref) {
            return null;
        }

        $this->meta->href = $previousHref;

        return $this->send(HttpMethod::GET);
    }

    /**
     * Массовое удаление сущностей.
     *
     * <code>
     * $product1 = $ms->query()->entity()->product()->byId('cc181c35-f259-11ed-0a80-00e900658c8f')->get();
     * $product2 = Product::make($ms, ['id' => 'd540c409-f259-11ed-0a80-00e900658e53']);
     * $product3 = ['meta' => Meta::product('d540c409-f259-11ed-0a80-00e900658e53')];
     *
     * Product::collection($ms)->massDelete([$product1, $product2, $product3]);
     *
     * //Или
     * $oranges = Product::collection($ms)->search('orange')->get();
     * Product::collection($ms)->massDelete($oranges);
     * </code>
     *
     * @throws RequestException
     */
    public function massDelete(mixed $objects): static
    {
        $objects = CollectionHelper::extractRows($objects);

        return $this->sendAndWrapResponse(HttpMethod::POST, $objects, 'delete');
    }

    /**
     * Массовое изменение и/или удаление сущностей. Сущности с id будут обновлены, без - созданы.
     *
     * <code>
     * $product1 = ['name' => 'Корнишоны'];
     * $product2 = Product::make($ms, [
     *  'id' => 'efcddaff-f308-11ed-0a80-09ee0084c2c6',
     *  'name' => 'Кабачки',
     * ]);
     * $product3 = [
     *  'meta' => Meta::product('1a4d67b8-f309-11ed-0a80-086800825780'),
     *  'name' => 'Патиссоны',
     * ];
     *
     * $products = Product::collection($ms)
     *  ->massCreateUpdate([$product1, $product2, $product3]);
     *
     * //Или
     * $updatableProducts = Product::collection($ms)->get();
     * $updatableProducts->each(function (Product $product) {
     *  $product->name = mb_strtoupper($product->name);
     * });
     * $products = Product::collection($ms)->massCreateUpdate($updatableProducts);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/#mojsklad-json-api-obschie-swedeniq-sozdanie-i-obnowlenie-neskol-kih-ob-ektow
     *
     * @throws RequestException
     */
    public function massCreateUpdate(mixed $objects): static
    {
        $objects = CollectionHelper::extractRows($objects);

        return $this->sendAndWrapResponse(HttpMethod::POST, $objects);
    }

    /**
     * @throws RequestException
     */
    protected function send(HttpMethod $method, mixed $body = []): static
    {
        $payload = $this->makePayload($method, $body);

        $response = $this->ms->getApiClient()->send($payload);
        if (!RecordHelper::isCollection($this->ms, $response)) {
            throw new InvalidArgumentException('Response must be a collection, object received');
        }

        $this->hydrate($response);

        return $this;
    }

    /**
     * @throws RequestException
     */
    protected function sendAndWrapResponse(HttpMethod $method, mixed $body, ?string $additionalSegment = null): static
    {
        $response = [];
        $meta = $this->meta ?? null;
        $context = $this->context ?? null;
        if ($meta) {
            $response['meta'] = $meta;
        }
        if ($context) {
            $response['context'] = $context;
        }

        $payload = $this->makePayload($method, $body, $additionalSegment);
        $response['rows'] = $this->ms->getApiClient()->send($payload);

        $this->hydrate($response);

        return $this;
    }

    protected function makePayload(HttpMethod $method, mixed $body, ?string $additionalSegment = null): Payload
    {
        [$path, $params] = Url::parsePathAndParams($this->meta->href);
        $path = $additionalSegment ?
            [...$path, $additionalSegment] :
            $path;

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $body,
        );
    }
}
