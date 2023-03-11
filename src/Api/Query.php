<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\Endpoints\AuditSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\EndpointSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\NotificationSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\ReportSegment;
use Evgeek\Moysklad\Http\ApiClient;

class Query extends AbstractBuilder
{
    public function __construct(ApiClient $api)
    {
        parent::__construct($api, [], []);
    }

    /**
     * Generic endpoint method
     * <code>
     * $products = $ms->query()
     *  ->endpoint('entity')
     *  ->product()
     *  ->get();
     * </code>
     */
    public function endpoint(string $endpoint): EndpointSegmentCommon
    {
        return $this->resolveCommonBuilder(EndpointSegmentCommon::class, $endpoint);
    }

    /**
     * Entities and documents endpoint
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/
     */
    public function entity(): EntitySegment
    {
        return $this->resolveNamedBuilder(EntitySegment::class);
    }

    /**
     * Reports endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/reports/#otchety
     */
    public function report(): ReportSegment
    {
        return $this->resolveNamedBuilder(ReportSegment::class);
    }

    /**
     * Audit endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#audit
     */
    public function audit(): AuditSegment
    {
        return $this->resolveNamedBuilder(AuditSegment::class);
    }

    /**
     * Notifications endpoint
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#uwedomleniq
     */
    public function notification(): NotificationSegment
    {
        return $this->resolveNamedBuilder(NotificationSegment::class);
    }

    protected function makeCurrentPath(): array
    {
        return $this->prevPath;
    }
}
