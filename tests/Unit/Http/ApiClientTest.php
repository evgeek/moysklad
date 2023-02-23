<?php

namespace Evgeek\Tests\Unit\Http;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Exceptions\RequestException;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Http\ApiClient;
use Evgeek\Moysklad\Http\GuzzleSender;
use Evgeek\Moysklad\Http\Payload;
use GuzzleHttp\Psr7\Response;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use RuntimeException;
use UnexpectedValueException;

/** @covers \Evgeek\Moysklad\Http\ApiClient */
class ApiClientTest extends TestCase
{
    private const PATH = [
        'entity',
        'product',
    ];
    private const PARAMS = [
        'limit' => '1',
        'filter' => 'filter_param_1=filter_value_1;filter_param_2=true',
    ];
    private const BODY = [
        'body_param_1' => 'body_value_1',
        'body_param_2' => ['body_param_3' => 'body_value_3'],
    ];
    private const BODY_STRING = '{"body_param_1":"body_value_1","body_param_2":{"body_param_3":"body_value_3"}}';
    private const GENERATOR_TEMPLATE = [
        'meta' => [
            'limit' => 100,
            'offset' => 0,
            'nextHref' => 'fake_href_1',
        ],
        'rows' => [
            [
                'id' => 'id1',
                'value' => 'value1',
            ],
            [
                'id' => 'id2',
                'value' => 'value2',
            ],
        ],
    ];
    private const TOKEN = 'fake-token';
    private const LOGIN = 'fake-login';
    private const PASSWORD = 'fake-password';
    private const CREDENTIALS_TOKEN = [self::TOKEN];
    private const TOKEN_HEADER = 'Bearer ' . self::TOKEN;
    private const CREDENTIALS_LOGIN_PASSWORD = [self::LOGIN, self::PASSWORD];
    private const LOGIN_PASSWORD_HEADER = 'Basic ZmFrZS1sb2dpbjpmYWtlLXBhc3N3b3Jk';

    private ApiClient $api;
    private MockObject|GuzzleSender $requestSender;

    protected function setUp(): void
    {
        $this->requestSender = $this->getMockBuilder(GuzzleSender::class)
            ->getMock();
        $this->api = new ApiClient(self::CREDENTIALS_TOKEN, new ArrayFormat(), $this->requestSender);
    }

    public function testSendCreatesRequestAndReturnsFormattedResponse(): void
    {
        $payload = new Payload(HttpMethod::POST, self::PATH, self::PARAMS, self::BODY);

        $this->requestSender->expects($this->once())
            ->method('send')
            ->with($this->callback(
                fn (RequestInterface $request) => strtolower($request->getMethod()) === 'post'
                    && $request->getHeader('content-type')[0] === 'application/json'
                    && $request->getUri()->getScheme() === 'https'
                    && $request->getHeader('host')[0] === 'online.moysklad.ru'
                    && $request->getUri()->getHost() === 'online.moysklad.ru'
                    && $request->getHeader('authorization')[0] === self::TOKEN_HEADER
                    && $request->getUri()->getPath() === '/api/remap/1.2/entity/product'
                    && $request->getUri()->getQuery() === http_build_query(self::PARAMS)
                    && $request->getBody()->getContents() === self::BODY_STRING
            ))
            ->willReturn(new Response(status: 200, body: '{"status":"ok"}'));

        $formattedResponse = $this->api->send($payload);

        $this->assertSame(['status' => 'ok'], $formattedResponse);
    }

    public function testSendThrowsWrappedException(): void
    {
        $payload = new Payload(HttpMethod::POST, self::PATH, self::PARAMS, self::BODY);

        $exceptionMessage = 'Something went wrong';
        $this->requestSender->expects($this->once())
            ->method('send')
            ->willThrowException(new RuntimeException($exceptionMessage));

        $this->expectException(RequestException::class);
        $this->expectExceptionMessage($exceptionMessage);

        $this->api->send($payload);
    }

    public function testGeneratorIteratesApi(): void
    {
        $limit = 2;
        $offset = 9;
        $queryParams = [
            'limit' => $limit,
            'offset' => $offset,
        ];
        $payload = new Payload(HttpMethod::GET, self::PATH, $queryParams, self::BODY);

        $requestCount = 0;
        $this->requestSender->expects($this->exactly(3))
            ->method('send')
            ->with($this->callback(function (RequestInterface $request) use (&$requestCount, $limit, $offset, $queryParams) {
                [$requestLimit, $requestOffset] = self::getLimitOffsetFromRequest($request);
                $queryParams['offset'] = $requestOffset;

                return $requestOffset === $offset + $limit * $requestCount++
                    && $requestLimit === $limit
                    && strtolower($request->getMethod()) === 'get'
                    && $request->getUri()->getPath() === '/api/remap/1.2/entity/product'
                    && $request->getUri()->getQuery() === http_build_query($queryParams)
                    && $request->getBody()->getContents() === self::BODY_STRING;
            }))
            ->willReturnCallback(static function (RequestInterface $request) use ($limit, $offset) {
                [$requestLimit, $requestOffset] = self::getLimitOffsetFromRequest($request);

                $responseBody = self::GENERATOR_TEMPLATE;
                $responseBody['meta']['limit'] = $requestLimit;
                $responseBody['meta']['offset'] = $requestOffset;
                $responseBody['rows'][0]['id'] = 'id' . ($requestOffset + 1);
                $responseBody['rows'][0]['value'] = 'value' . ($requestOffset + 1);
                $responseBody['rows'][1]['id'] = 'id' . ($requestOffset + 2);
                $responseBody['rows'][1]['value'] = 'value' . ($requestOffset + 2);

                // Emulate 3 response with 5 rows total
                if ($requestOffset >= ($limit * 2 + $offset)) {
                    $responseBody['meta']['nextHref'] = null;
                    unset($responseBody['rows'][1]);
                }

                return new Response(status: 200, body: json_encode($responseBody, JSON_THROW_ON_ERROR));
            });

        $generator = $this->api->getGenerator($payload);

        $rowsCount = $offset;
        foreach ($generator as $row) {
            ++$rowsCount;
            $this->assertSame('id' . $rowsCount, $row['id']);
            $this->assertSame('value' . $rowsCount, $row['value']);
        }

        $this->assertSame(3, $requestCount);
        $this->assertSame(5 + $offset, $rowsCount);
    }

    public function testGeneratorThrowWithoutRows(): void
    {
        $this->assertGeneratorThrowWithout(
            "Response is non-iterable (missed 'rows' property)",
            function (array $responseBody) {
                unset($responseBody['rows']);

                return $responseBody;
            }
        );
    }

    /** @dataProvider limitOffsetDataProvider */
    public function testGeneratorThrowWithoutLimitOffset(string $param): void
    {
        $this->assertGeneratorThrowWithout(
            "Response is non-iterable (missed 'limit' or 'offset' property)",
            function (array $responseBody) use ($param) {
                unset($responseBody['meta'][$param]);

                return $responseBody;
            }
        );
    }

    public function testDebug(): void
    {
        $payload = new Payload(HttpMethod::GET, self::PATH, self::PARAMS, self::BODY);
        $url = 'https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=filter_param_1=filter_value_1;filter_param_2=true';
        $urlEncoded = 'https://online.moysklad.ru/api/remap/1.2/entity/product?limit=1&filter=filter_param_1%3Dfilter_value_1%3Bfilter_param_2%3Dtrue';
        $expected = [
            'method' => 'GET',
            'url' => $url,
            'url_encoded' => $urlEncoded,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => self::TOKEN_HEADER,
            ],
            'body' => self::BODY,
        ];

        $result = $this->api->debug($payload);

        $this->assertSame($expected, $result);
    }

    public function testCorrectCredentialsToken(): void
    {
        $api = new ApiClient(self::CREDENTIALS_TOKEN, new ArrayFormat(), $this->requestSender);
        $payload = new Payload(HttpMethod::GET, self::PATH, [], null);

        $this->requestSender->expects($this->once())
            ->method('send')
            ->with($this->callback(
                fn (RequestInterface $request) => $request->getHeader('authorization')[0] === self::TOKEN_HEADER
            ))
            ->willReturn(new Response(status: 200, body: '{"status":"ok"}'));

        $api->send($payload);
    }

    public function testCorrectCredentialsLoginPassword(): void
    {
        $api = new ApiClient(self::CREDENTIALS_LOGIN_PASSWORD, new ArrayFormat(), $this->requestSender);
        $payload = new Payload(HttpMethod::GET, self::PATH, [], null);

        $this->requestSender->expects($this->once())
            ->method('send')
            ->with($this->callback(
                fn (RequestInterface $request) => $request->getHeader('authorization')[0] === self::LOGIN_PASSWORD_HEADER
            ))
            ->willReturn(new Response(status: 200, body: '{"status":"ok"}'));

        $api->send($payload);
    }

    public function testNotListCredentialsThrow(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Credentials must be a list array');

        $credentials = [
            'login' => 'login',
            'password' => 'password',
        ];
        new ApiClient($credentials, new ArrayFormat(), $this->requestSender);
    }

    public function testWrongCountCredentialsThrow(): void
    {
        $expectedMessage = 'The size of the credential array must be equal to 1 for a token or 2 for a login-password, 3 provided';
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($expectedMessage);

        $credentials = [
            'login',
            'password',
            'token',
        ];
        new ApiClient($credentials, new ArrayFormat(), $this->requestSender);
    }

    private function limitOffsetDataProvider(): array
    {
        return [
            ['limit'],
            ['offset'],
        ];
    }

    private function assertGeneratorThrowWithout(string $expectedExceptionMessage, callable $unsetCallback): void
    {
        $payload = new Payload(HttpMethod::GET, self::PATH, [], null);

        $this->requestSender->expects($this->once())
            ->method('send')
            ->willReturnCallback(function () use ($unsetCallback) {
                $responseBody = self::GENERATOR_TEMPLATE;
                $responseBody = $unsetCallback($responseBody);
                unset($responseBody['meta']['limit']);

                return new Response(status: 200, body: json_encode($responseBody, JSON_THROW_ON_ERROR));
            });

        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->api->getGenerator($payload)->next();
    }

    /** @return int[] */
    private static function getLimitOffsetFromRequest(RequestInterface $request): array
    {
        $params = [];
        parse_str($request->getUri()->getQuery(), $params);

        return [(int) $params['limit'], (int) $params['offset']];
    }
}
