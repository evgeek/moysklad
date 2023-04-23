<?php

namespace Evgeek\Tests\Unit\Api\Traits\Segments;

use Evgeek\Moysklad\Api\AbstractBuilder;
use Evgeek\Moysklad\Api\Segments\AbstractSegmentCommon;
use Evgeek\Moysklad\Api\Segments\Methods\AbstractMethodSegmentNamed;
use Evgeek\Moysklad\Api\Segments\Methods\Nested\PositionsSegment;
use Evgeek\Moysklad\Api\Segments\Methods\Nested\SettingsSegment;
use Evgeek\Moysklad\Api\Traits\Segments\PositionsTrait;
use Evgeek\Moysklad\Api\Traits\Segments\SettingsTrait;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/** @covers \Evgeek\Moysklad\Api\Traits\Segments\SettingsTrait */
class SettingsTraitTest extends TraitTestCase
{
    public function testReturnsCorrectClass(): void
    {
        $builder = (new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractSegmentCommon {
            use SettingsTrait;
        })->settings();

        $this->assertInstanceOf(SettingsSegment::class, $builder);
        $this->assertInstanceOf(AbstractMethodSegmentNamed::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
