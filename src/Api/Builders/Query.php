<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Builders;

use Evgeek\Moysklad\Api\Builders\Endpoints\Audit;
use Evgeek\Moysklad\Api\Builders\Endpoints\EndpointCommon;
use Evgeek\Moysklad\Api\Builders\Endpoints\Entity;
use Evgeek\Moysklad\Api\Builders\Endpoints\Notification;
use Evgeek\Moysklad\Api\Builders\Endpoints\Report;
use Evgeek\Moysklad\Http\ApiClient;

final class Query extends Builder
{
    public function __construct(ApiClient $api)
    {
        parent::__construct($api, []);
    }

    /**
     * Generic endpoint method
     * <code>
     * $products = $ms->query()
     *      ->endpoint('entity')
     *      ->product()
     *      ->get();
     * </code>
     */
    public function endpoint(string $endpoint): EndpointCommon
    {
        return $this->resolveCommonBuilder(EndpointCommon::class, $endpoint);
    }

    /**
     * Entities and documents endpoint
     * <code>
     * $products = $ms->query()
     *      ->entity()
     *      ->product()
     *      ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/
     */
    public function entity(): Entity
    {
        return $this->resolveNamedBuilder(Entity::class);
    }

    /**
     * Reports endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/reports/#otchety
     */
    public function report(): Report
    {
        return $this->resolveNamedBuilder(Report::class);
    }

    /**
     * Audit endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#audit
     */
    public function audit(): Audit
    {
        return $this->resolveNamedBuilder(Audit::class);
    }

    /**
     * Notifications endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#uwedomleniq
     */
    public function notification(): Notification
    {
        return $this->resolveNamedBuilder(Notification::class);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
