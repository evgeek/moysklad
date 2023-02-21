<?php

namespace Evgeek\Tests\Unit\Api\Traits\Actions;

use Evgeek\Moysklad\Api\Segments\AbstractSegmentNamed;
use Evgeek\Moysklad\Api\Traits\Actions\SendTrait;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\InputException;
use Evgeek\Tests\Unit\Api\Traits\TraitTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\AbstractBuilder::apiSend
 * @covers \Evgeek\Moysklad\Api\AbstractBuilder::getEnumHttpMethod
 * @covers \Evgeek\Moysklad\Api\Traits\Actions\SendTrait
 */
class SendTraitTest extends TraitTestCase
{
    public function testSendWithEnumHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use SendTrait;

            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::CONNECT, static::PATH, static::PARAMS, static::BODY);
        $builder->send(HttpMethod::CONNECT, static::BODY);
    }

    public function testSendWithStringHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use SendTrait;
            protected const SEGMENT = 'test_segment';
        };

        $this->expectsSendCalledWith(HttpMethod::HEAD, static::PATH, static::PARAMS, static::BODY);
        $builder->send('head', static::BODY);
    }

    public function testSendWithWrongStringHttpMethod(): void
    {
        $builder = new class($this->api, static::PREV_PATH, static::PARAMS) extends AbstractSegmentNamed {
            use SendTrait;
            protected const SEGMENT = 'test_segment';
        };

        $this->expectException(InputException::class);
        $this->expectExceptionMessage("'WRONG-METHOD' is not valid HTTP method. Check Evgeek\\Moysklad\\Enums\\HttpMethod");
        $builder->send('wrong-method', static::BODY);
    }
}
