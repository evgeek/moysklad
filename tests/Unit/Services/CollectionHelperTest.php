<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\CollectionHelper;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\CollectionHelper */
class CollectionHelperTest extends TestCase
{
    private MoySklad $ms;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad(['token']);
    }

    public function testRowsCorrectlyExtractedFromCollection(): void
    {
        $content = [
            ['name' => 'orange'],
            ['name' => 'lime'],
        ];
        $collection = new UnknownCollection($this->ms, ['endpoint', 'segment'], 'type', ['rows' => $content]);
        $rows = CollectionHelper::extractRows($collection);

        $this->assertSame($content, json_decode(json_encode($rows), true));
    }

    public function testRowsDoesNotExtractedFromNotCollection(): void
    {
        $content = 'test-content';
        $rows = CollectionHelper::extractRows($content);

        $this->assertSame($content, $rows);
    }
}
