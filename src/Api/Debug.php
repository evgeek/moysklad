<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\Special\MassDelete;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;

final class Debug extends Builder
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
     *
     * @throws FormatException
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
     *
     * @throws FormatException
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
     *
     * @throws FormatException
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
     *
     * @throws FormatException
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
     *
     * @throws FormatException
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
     *
     * @throws FormatException
     * @throws InputException
     */
    public function send(HttpMethod|string $method, mixed $body = null)
    {
        return $this->apiDebug($this->getEnumMethod($method), $body);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
