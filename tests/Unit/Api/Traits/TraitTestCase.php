<?php

namespace Evgeek\Tests\Unit\Api\Traits;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\BuilderNamed;
use Evgeek\Moysklad\Api\Traits\Actions\CreateTrait;
use Evgeek\Moysklad\Api\Traits\Actions\DebugTrait;
use Evgeek\Moysklad\Api\Traits\Actions\DeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetGeneratorTrait;
use Evgeek\Moysklad\Api\Traits\Actions\GetTrait;
use Evgeek\Moysklad\Api\Traits\Actions\MassDeleteTrait;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Api\Traits\Actions\UpdateTrait;
use Evgeek\Moysklad\Api\Traits\Builders\AttributesTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdCommonTrait;
use Evgeek\Moysklad\Api\Traits\Builders\ByIdPositionedTrait;
use Evgeek\Tests\Unit\Api\ApiTestCase;

abstract class TraitTestCase extends ApiTestCase
{
    protected const PATH = [
        'test_endpoint',
        'test_method',
        'test_path',
    ];
    protected Builder $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends BuilderNamed {
            use AttributesTrait;
            use ByIdCommonTrait;
            use ByIdPositionedTrait {
                ByIdCommonTrait::byId insteadof ByIdPositionedTrait;
                ByIdCommonTrait::byId as byIdCommon;
                ByIdPositionedTrait::byId as byIdPositioned;
            }
            use CreateTrait;
            use DebugTrait;
            use DeleteTrait;
            use GetGeneratorTrait;
            use GetTrait;
            use MassDeleteTrait;
            use SendTrait;
            use UpdateTrait;

            protected const NAME = 'test_path';
        };
    }
}
