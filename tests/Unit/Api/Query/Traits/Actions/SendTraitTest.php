<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Actions;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Query\AbstractBuilder::apiSend
 * @covers \Evgeek\Moysklad\Api\Query\Traits\Actions\SendTrait
 */
class SendTraitTest extends TraitTestCase
{
    public function testSendWithEnumHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::CONNECT, static::PATH, static::PARAMS, static::BODY);
        $builder->send(HttpMethod::CONNECT, static::BODY);
    }

    public function testSendWithStringHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::HEAD, static::PATH, static::PARAMS, static::BODY);
        $builder->send('head', static::BODY);
    }

    public function testSendWithWrongStringHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractNamedSegment {
            protected const SEGMENT = 'test_segment';
        };

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("'WRONG-METHOD' is not valid HTTP method");
        $builder->send('wrong-method', static::BODY);
    }
}
