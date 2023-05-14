<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api;

use Evgeek\Moysklad\Api\Segments\Endpoints\AuditSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\EndpointSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\NotificationSegment;
use Evgeek\Moysklad\Api\Segments\Endpoints\ReportSegment;
use Evgeek\Moysklad\Api\Segments\Methods\MethodSegmentCommon;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Services\Url;

class Query extends AbstractBuilder
{
    public function __construct(ApiClient $api)
    {
        parent::__construct($api, [], []);
    }

    public function fromUrl(string $url): MethodSegmentCommon
    {
        [$path, $params] = Url::parsePathAndParams($url);
        $lastSegment = array_pop($path);

        return new MethodSegmentCommon($this->api, $path, $params, $lastSegment);
    }

    /**
     * Универсальный метод входных точек API
     *
     * <code>
     * $products = $ms->query()
     *  ->endpoint('entity')
     *  ->product()
     *  ->get();
     * </code>
     */
    public function endpoint(string $name): EndpointSegmentCommon
    {
        return $this->resolveCommonBuilder(EndpointSegmentCommon::class, $name);
    }

    /**
     * Входная точка для работы с Сущностями и Документами
     *
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
     * Входная точка для работы с Отчётами
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/reports/#otchety
     */
    public function report(): ReportSegment
    {
        return $this->resolveNamedBuilder(ReportSegment::class);
    }

    /**
     * Входная точка для работы с Аудитом
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/other/#audit
     */
    public function audit(): AuditSegment
    {
        return $this->resolveNamedBuilder(AuditSegment::class);
    }

    /**
     * Входная точка для работы с Уведомлениями
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
