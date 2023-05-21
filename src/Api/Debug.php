<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\Special\MassDeleteSegment;
use Evgeek\Moysklad\Enums\HttpMethod;

class Debug extends AbstractBuilder
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
        return (new MassDeleteSegment($this->api, $this->path, $this->params))->massDeleteDebug($body);
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
