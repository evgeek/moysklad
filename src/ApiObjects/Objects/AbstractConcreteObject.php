<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects;

use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetIdInMetaHrefTrait;
use Evgeek\Moysklad\ApiObjects\Objects\Traits\SetMetaTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

abstract class AbstractConcreteObject extends AbstractConcreteApiObject
{
    use SetIdInMetaHrefTrait;
    use SetMetaTrait;

    /**
     * @throws RequestException
     */
    public function send(HttpMethod|string $method): static
    {
        $payload = $this->makePayload(HttpMethod::makeFrom($method));

        $response = $this->ms->getApiClient()->send($payload);
        $this->hydrate($response);

        return $this;
    }

    /**
     * @throws RequestException
     */
    public function get(): static
    {
        return $this->send(HttpMethod::GET);
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
