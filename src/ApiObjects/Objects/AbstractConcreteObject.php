<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetPathTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

abstract class AbstractConcreteObject extends AbstractConcreteApiObject
{
    use SetMetaTrait;
    use SetPathTrait;

    /**
     * @throws RequestException
     */
    public function send(HttpMethod|string $method)
    {
        $payload = $this->makePayload(HttpMethod::makeFrom($method));

        return $this->ms->getApiClient()->send($payload);
    }

    protected function makePayload(HttpMethod $method): Payload
    {
        $href = $this->meta->href ?? null;
        if (!$href) {
            throw new InvalidArgumentException('Cannot find meta href');
        }

        [$path, $params] = Url::parsePathAndParams($href);

        return new Payload(
            method: $method,
            path: $path,
            params: $params,
            body: $this->toString(),
        );
    }
}
