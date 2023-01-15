<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders\Methods\Special;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;
use stdClass;

final class Debug extends Builder
{
    /**
     * Debug read request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->product()
     *      ->debug()
     *      ->get();
     * </code>
     *
     * @throws FormatException
     */
    public function get(): stdClass|array|string
    {
        return $this->apiDebug(HttpMethod::GET);
    }

    /**
     * Debug create request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->product()
     *      ->debug()
     *      ->create(['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     */
    public function create(stdClass|array|string $body): stdClass|array|string
    {
        return $this->apiDebug(HttpMethod::POST, $body);
    }

    /**
     * Debug update request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->update(['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     */
    public function update(stdClass|array|string $body): stdClass|array|string
    {
        return $this->apiDebug(HttpMethod::PUT, $body);
    }

    /**
     * Debug delete request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->delete();
     * </code>
     *
     * @throws FormatException
     */
    public function delete(): stdClass|array|string
    {
        return $this->apiDebug(HttpMethod::DELETE);
    }

    /**
     * Debug Mass Delete request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->customerorder()
     *      ->debug()
     *      ->massDelete($body);
     * </code>
     *
     * @throws FormatException
     */
    public function massDelete(stdClass|array|string $body): stdClass|array|string
    {
        return (new MassDelete($this->api, $this->path, $this->params))->massDeleteDebug($body);
    }

    /**
     * Debug general request
     * <code>
     * $debug = $ms->query
     *      ->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->send('PUT', ['name' => 'orange']);
     * </code>
     *
     * @throws FormatException
     * @throws InputException
     */
    public function send(HttpMethod|string $method, stdClass|array|string|null $body = null): stdClass|array|string
    {
        return $this->apiDebug($this->getEnumMethod($method), $body);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
