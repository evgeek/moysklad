<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\Special\MassDelete;
use Evgeek\Moysklad\Enums\HttpMethod;

class Debug extends AbstractBuilder
{
    /**
     * Debug read request
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
     * Debug create request
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
     * Debug update request
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
     * Debug delete request
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
     * Debug Mass Delete request
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
        return (new MassDelete($this->api, $this->path, $this->params))->massDeleteDebug($body);
    }

    /**
     * Debug general request
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
        return $this->apiDebug($this->getEnumHttpMethod($method), $body);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
