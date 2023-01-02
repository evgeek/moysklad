<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Methods\Special;

use Evgeek\Moysklad\Api\Methods\AbstractNamedMethod;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\FormatException;
use Evgeek\Moysklad\Exceptions\InputException;

class Debug extends AbstractNamedMethod
{
    protected const PATH = 'debug';

    /**
     * Debug read request
     * <code>
     * $debug = $ms->entity()
     *      ->product()
     *      ->debug()
     *      ->get();
     * </code>
     * @throws FormatException
     */
    public function get(): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::GET);
        return $this->apiDebug($payloadList);
    }

    /**
     * Debug create request
     * <code>
     * $debug = $ms->entity()
     *      ->product()
     *      ->debug()
     *      ->create(['name' => 'orange']);
     * </code>
     * @throws FormatException
     */
    public function create(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::POST, $body);
        return $this->apiDebug($payloadList);
    }

    /**
     * Debug update request
     * <code>
     * $debug = $ms->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->update(['name' => 'orange']);
     * </code>
     * @throws FormatException
     */
    public function update(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::PUT, $body);
        return $this->apiDebug($payloadList);
    }

    /**
     * Debug delete request
     * <code>
     * $debug = $ms->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->delete();
     * </code>
     * @throws FormatException
     */
    public function delete(): object|array|string
    {
        $payloadList = $this->addPayloadToList(HttpMethod::DELETE);
        return $this->apiDebug($payloadList);
    }

    /**
     * Debug Mass Delete request
     * @throws FormatException
     */
    public function massDelete(string|array|object $body): object|array|string
    {
        $payloadList = $this->addPayloadToList();
        return (new MassDelete($this->api, $payloadList))->massDeleteDebug($body);
    }

    /**
     * Debug general request
     * <code>
     * $debug = $ms->entity()
     *      ->product()
     *      ->byId('fb72fc83-7ef5-11e3-ad1c-002590a28eca')
     *      ->debug()
     *      ->send('PUT', ['name' => 'orange']);
     * </code>
     * @throws FormatException
     * @throws InputException
     */
    public function send(HttpMethod|string $method, string|array|object|null $body = null): object|array|string
    {
        $method = $this->getEnumMethod($method);
        $payloadList = $this->addPayloadToList($method, $body);
        return $this->apiDebug($payloadList);
    }
}
