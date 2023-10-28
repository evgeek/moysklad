<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query;

use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AccountSettingsSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\AuditSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ContextSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EndpointCommonSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\EntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\NotificationSegment;
use Evgeek\Moysklad\Api\Query\Segments\Endpoints\ReportSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\MethodCommonSegment;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Services\Url;

class QueryBuilder extends AbstractBuilder
{
    public function __construct(ApiClient $api)
    {
        parent::__construct($api, [], []);
    }

    /**
     * Инициализирует конструктор запросов из переданного $url.
     * Если $withParams === true, конструктор сохранит параметры из url, иначе - отбросит.
     *
     * <code>
     * $productUrl = "https://api.moysklad.ru/api/remap/1.2/entity/product/3aba2611-c64f-11ed-0a80-108a00230a9c?expand=image";
     * $product = $ms->query()
     *  ->fromUrl($productUrl, true)
     *  ->get();
     * </code>
     *
     * @param mixed $withParams
     */
    public function fromUrl(string $url, $withParams = false): MethodCommonSegment
    {
        [$path, $params] = Url::parsePathAndParams($url);
        $lastSegment = array_pop($path);
        if (!$withParams) {
            $params = [];
        }

        return new MethodCommonSegment($this->api, $path, $params, $lastSegment);
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
    public function endpoint(string $name): EndpointCommonSegment
    {
        return $this->resolveCommonBuilder(EndpointCommonSegment::class, $name);
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
     * Входная точка для работы с Контекстом
     *
     * <code>
     * $products = $ms->query()
     *  ->context()
     *  ->companysettings()
     *  ->get();
     * </code>
     */
    public function context(): ContextSegment
    {
        return $this->resolveNamedBuilder(ContextSegment::class);
    }

    /**
     * Входная точка для работы с настройками аккаунта
     *
     * <code>
     * $products = $ms->query()
     *  ->accountSettings()
     *  ->subscription()
     *  ->get();
     * </code>
     */
    public function accountSettings(): AccountSettingsSegment
    {
        return $this->resolveNamedBuilder(AccountSettingsSegment::class);
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
