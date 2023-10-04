<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query;

use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Services\CollectionHelper;

class DebugBuilder extends AbstractBuilder
{
    /**
     * Возвращает отладочную информацию запроса на чтение.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->debug()
     *  ->get();
     * </code>
     */
    public function get()
    {
        return $this->apiDebug(HttpMethod::GET);
    }

    /**
     * Возвращает отладочную информацию запроса на создание.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->debug()
     *  ->create(['name' => 'orange']);
     * </code>
     */
    public function create(mixed $body)
    {
        return $this->apiDebug(HttpMethod::POST, $body);
    }

    /**
     * Возвращает отладочную информацию запроса на изменение.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->debug()
     *  ->update(['name' => 'orange']);
     * </code>
     */
    public function update(mixed $body)
    {
        return $this->apiDebug(HttpMethod::PUT, $body);
    }

    /**
     * Возвращает отладочную информацию запроса на массовое создание/обновление.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->debug()
     *  ->massCreateUpdate([
     *      ['name' => 'Корнишоны'],
     *      ['id' => 'b0d7855d-e1ea-11ed-0a80-0f3f0023b58a', 'name' => 'Черешня'],
     * ]);
     * </code>
     */
    public function massCreateUpdate(mixed $body)
    {
        $objects = CollectionHelper::extractRows($body);

        return $this->apiDebug(HttpMethod::POST, $objects);
    }

    /**
     * Возвращает отладочную информацию запроса на удаление.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->debug()
     *  ->delete();
     * </code>
     */
    public function delete()
    {
        return $this->apiDebug(HttpMethod::DELETE);
    }

    /**
     * Возвращает отладочную информацию запроса на массовое удаление.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->customerorder()
     *  ->debug()
     *  ->massDelete($body);
     * </code>
     */
    public function massDelete(mixed $body)
    {
        return (new MassSegmentDelete($this->api, $this->path, $this->params))->massDeleteDebug($body);
    }

    /**
     * Возвращает отладочную информацию произвольного запроса.
     *
     * <code>
     * $debug = $ms->query
     *  ->entity()
     *  ->product()
     *  ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *  ->debug()
     *  ->send('PUT', ['name' => 'orange']);
     * </code>
     */
    public function send(HttpMethod|string $method, mixed $body = null)
    {
        return $this->apiDebug(HttpMethod::makeFrom($method), $body);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
