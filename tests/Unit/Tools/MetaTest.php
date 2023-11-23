<?php

namespace Evgeek\Tests\Unit\Tools;

use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Processing;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Organization;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\Formatters\StringFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Meta;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

/** @covers \Evgeek\Moysklad\Tools\Meta */
class MetaTest extends TestCase
{
    private const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    private const GUID2 = 'f731148b-a93d-11ed-0a80-0fba0011a6c6';

    public function testFormatSetter(): void
    {
        Meta::setFormat(new ArrayFormat());
        $this->assertIsArray(Meta::organization(self::GUID1));

        Meta::setFormat(new StringFormat());
        $this->assertIsString(Meta::organization(self::GUID1));

        Meta::setFormat(new StdClassFormat());
        $this->assertInstanceOf(stdClass::class, Meta::organization(self::GUID1));
    }

    /** @dataProvider correctPathAndTypeDataProvider */
    public function testCreateFromPathWithStringSegmentsWorks(string $expectedSegments, array $path, string $type): void
    {
        Meta::setFormat(new ArrayFormat());

        $meta = Meta::create($path, $type);
        $expected = [
            'href' => Url::API . $expectedSegments,
            'type' => $type,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expected, $meta);
    }

    public static function correctPathAndTypeDataProvider(): array
    {
        return [
            ['', [], 'type1'],
            ['/endpoint', ['endpoint'], 'type2'],
            ['/endpoint/method', ['endpoint', 'method'], 'type3'],
        ];
    }

    /** @dataProvider incorrectPathSegmentDataProvider */
    public function testCreateFromPathWithNotStringSegmentsDoesNotWorks(mixed $segment): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('1th segment of path is not a string');

        Meta::create(['endpoint', $segment], 'type');
    }

    public static function incorrectPathSegmentDataProvider(): array
    {
        return [
            [null],
            [false],
            [true],
            [0],
            [1.1],
            [['segment']],
            [new stdClass()],
        ];
    }

    public function testEntity(): void
    {
        Meta::setFormat(new ArrayFormat());

        $meta = Meta::entity(['product', self::GUID1], 'product');
        $expected = [
            'href' => Url::API . '/entity/product/' . self::GUID1,
            'type' => 'product',
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expected, $meta);
    }

    /** @dataProvider methodsWithCorrespondingPathAndTypes */
    public function testMethodReturnsCorrectClass(
        string $method,
        string $expectedPath,
        string $expectedType,
        bool $withId = true,
        ObjectInterface|string|array $parent = []
    ): void {
        $withId ?
            $this->assertMetaMethodByGuidWorks($method, $expectedPath, $expectedType, $parent) :
            $this->assertMetaMethodWithoutGuidWorks($method, $expectedPath, $expectedType, $parent);
    }

    public static function methodsWithCorrespondingPathAndTypes(): array
    {
        $ms = new MoySklad(['']);

        $parentProduct = Product::make($ms, ['id' => self::GUID1]);
        $parentCounterparty = Counterparty::make($ms, ['id' => self::GUID1]);
        $parentProcessingPlan = ProcessingPlan::make($ms, ['id' => self::GUID1]);

        return [
            Type::BONUSTRANSACTION => ['bonustransaction', 'entity/bonustransaction', 'bonustransaction'],
            Type::BONUSPROGRAM => ['bonusprogram', 'entity/bonusprogram', 'bonusprogram'],
            Type::CURRENCY => ['currency', 'entity/currency', 'currency'],
            Type::WEBHOOK => ['webhook', 'entity/webhook', 'webhook'],
            Type::WEBHOOKSTOCK => ['webhookstock', 'entity/webhookstock', 'webhookstock'],
            Type::PRODUCTFOLDER => ['productfolder', 'entity/productfolder', 'productfolder'],
            Type::CONTRACT => ['contract', 'entity/contract', 'contract'],
            Type::UOM => ['uom', 'entity/uom', 'uom'],
            Type::TASK => ['task', 'entity/task', 'task'],
            Type::IMAGE => ['image', 'entity/product/' . self::GUID1 . '/images', 'image', true, $parentProduct],
            Type::SALESCHANNEL => ['saleschannel', 'entity/saleschannel', 'saleschannel'],
            Type::CASHIER => ['cashier', 'entity/product/' . self::GUID1 . '/cashiers', 'cashier', true, $parentProduct],
            Type::BUNDLE => ['bundle', 'entity/bundle', 'bundle'],
            Type::COUNTERPARTY => ['counterparty', 'entity/counterparty', 'counterparty'],
            Type::VARIANT => ['variant', 'entity/variant', 'variant'],
            Type::COMPANYSETTINGS => ['companysettings', 'context/companysettings', 'companysettings', false],
            Type::USERSETTINGS => ['usersettings', 'context/usersettings', 'usersettings', false],
            Type::GROUP => ['group', 'entity/group', 'group'],
            Type::CUSTOMROLE => ['role', 'entity/role', 'customrole'],
            Type::CUSTOMENTITY => ['customentity', 'entity/customentity', 'customentity'],
            Type::PROJECT => ['project', 'entity/project', 'project'],
            Type::REGION => ['region', 'entity/region', 'region'],
            Type::CONSIGNMENT => ['consignment', 'entity/consignment', 'consignment'],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', 'entity/accumulationdiscount', 'accumulationdiscount'],
            Type::PERSONALDISCOUNT => ['personaldiscount', 'entity/personaldiscount', 'personaldiscount'],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', 'entity/specialpricediscount', 'specialpricediscount'],
            Type::STORE => ['store', 'entity/store', 'store'],
            Type::EMPLOYEE => ['employee', 'entity/employee', 'employee'],
            Type::NAMEDFILTER => ['namedfilter', 'entity/product/namedfilter', 'namedfilter', true, 'product'],
            Type::TAXRATE => ['taxrate', 'entity/taxrate', 'taxrate'],
            Type::STATE => ['state', 'entity/counterparty/metadata/states', 'state', true, 'counterparty'],
            Type::EXPENSEITEM => ['expenseitem', 'entity/expenseitem', 'expenseitem'],
            Type::COUNTRY => ['country', 'entity/country', 'country'],
            Type::PROCESSINGPLAN => ['processingplan', 'entity/processingplan', 'processingplan'],
            Type::PROCESSINGPLANSTAGES => ['processingplanstages', 'entity/processingplan/' . self::GUID1 . '/stages', 'processingplanstages', true, $parentProcessingPlan],
            Type::PROCESSINGPLANMATERIAL => ['processingplanmaterial', 'entity/processingplan/' . self::GUID1 . '/materials', 'processingplanmaterial', true, $parentProcessingPlan],
            Type::PROCESSINGPLANRESULT => ['processingplanresult', 'entity/processingplan/' . self::GUID1 . '/products', 'processingplanresult', true, $parentProcessingPlan],
            Type::PROCESSINGPROCESS => ['processingprocess', 'entity/processingprocess', 'processingprocess'],
            Type::PRICETYPE => ['pricetype', 'context/companysettings/pricetype', 'pricetype'],
            Type::PRODUCT => ['product', 'entity/product', 'product'],
            Type::RETAILSTORE => ['retailstore', 'entity/retailstore', 'retailstore'],
            Type::SERVICE => ['service', 'entity/service', 'service'],
            Type::FILES => ['files', 'entity/counterparty/' . self::GUID1 . '/files', 'files', true, $parentCounterparty],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', 'entity/counterparty/metadata/embeddedtemplate', 'embeddedtemplate', true, Counterparty::make($ms)],
            Type::CUSTOMTEMPLATE => ['customtemplate', 'entity/counterparty/metadata/customtemplate', 'customtemplate', true, Counterparty::make($ms)],
            Type::ORGANIZATION => ['organization', 'entity/organization', 'organization'],
            Type::ACCOUNT => ['account', 'entity/organization/' . self::GUID1 . '/accounts', 'account', true, Organization::make($ms, ['id' => self::GUID1])],
            Type::PROCESSINGSTAGE => ['processingstage', 'entity/processingstage', 'processingstage'],
            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', 'entity/retaildrawercashin', 'retaildrawercashin'],
            Type::INTERNALORDER => ['internalorder', 'entity/internalorder', 'internalorder'],
            Type::SALESRETURN => ['salesreturn', 'entity/salesreturn', 'salesreturn'],
            Type::PURCHASERETURN => ['purchasereturn', 'entity/purchasereturn', 'purchasereturn'],
            Type::PREPAYMENTRETURN => ['prepaymentreturn', 'entity/prepaymentreturn', 'prepaymentreturn'],
            Type::PAYMENTIN => ['paymentin', 'entity/paymentin', 'paymentin'],
            Type::COMMISSIONREPORTOUT => ['commissionreportout', 'entity/commissionreportout', 'commissionreportout'],
            Type::RETAILDRAWERCASHOUT => ['retaildrawercashout', 'entity/retaildrawercashout', 'retaildrawercashout'],
            Type::PROCESSINGORDER => ['processingorder', 'entity/processingorder', 'processingorder'],
            Type::CUSTOMERORDER => ['customerorder', 'entity/customerorder', 'customerorder'],
            Type::PURCHASEORDER => ['purchaseorder', 'entity/purchaseorder', 'purchaseorder'],
            Type::INVENTORY => ['inventory', 'entity/inventory', 'inventory'],
            Type::PAYMENTOUT => ['paymentout', 'entity/paymentout', 'paymentout'],
            Type::COUNTERPARTYADJUSTMENT => ['counterpartyadjustment', 'entity/counterpartyadjustment', 'counterpartyadjustment'],
            Type::ENTER => ['enter', 'entity/enter', 'enter'],
            Type::DEMAND => ['demand', 'entity/demand', 'demand'],
            Type::MOVE => ['move', 'entity/move', 'move'],
            Type::RETURNTOCOMMISSIONERPOSITION => ['returntocommissionerposition', 'entity/commissionreportin/' . self::GUID1 . '/returntocommissionerpositions', 'returntocommissionerposition', true, CommissionReportIn::make($ms, ['id' => self::GUID1])],
            Type::COMMISSIONREPORTIN => ['commissionreportin', 'entity/commissionreportin', 'commissionreportin'],
            Type::PRICELIST => ['pricelist', 'entity/pricelist', 'pricelist'],
            Type::PREPAYMENT => ['prepayment', 'entity/prepayment', 'prepayment'],
            Type::SUPPLY => ['supply', 'entity/supply', 'supply'],
            Type::CASHIN => ['cashin', 'entity/cashin', 'cashin'],
            Type::CASHOUT => ['cashout', 'entity/cashout', 'cashout'],
            Type::RETAILDEMAND => ['retaildemand', 'entity/retaildemand', 'retaildemand'],
            Type::RETAILSHIFT => ['retailshift', 'entity/retailshift', 'retailshift'],
            Type::RETAILSALESRETURN => ['retailsalesreturn', 'entity/retailsalesreturn', 'retailsalesreturn'],
            Type::LOSS => ['loss', 'entity/loss', 'loss'],
            Type::INVOICEOUT => ['invoiceout', 'entity/invoiceout', 'invoiceout'],
            Type::INVOICEIN => ['invoicein', 'entity/invoicein', 'invoicein'],
            Type::FACTUREOUT => ['factureout', 'entity/factureout', 'factureout'],
            Type::FACTUREIN => ['facturein', 'entity/facturein', 'facturein'],
            Type::PROCESSING => ['processing', 'entity/processing', 'processing'],
            Type::PROCESSINGPOSITIONMATERIAL => ['processingpositionmaterial', 'entity/processing/' . self::GUID1 . '/materials', 'processingpositionmaterial', true, Processing::make($ms, ['id' => self::GUID1])],
            Type::PROCESSINGPOSITIONRESULT => ['processingpositionresult', 'entity/processing/' . self::GUID1 . '/products', 'processingpositionresult', true, Processing::make($ms, ['id' => self::GUID1])],
        ];
    }

    private function assertMetaMethodByGuidWorks(string $method, string $expectedPath, string $expectedType, ObjectInterface|string|array $parent): void
    {
        $meta = $parent ?
            Meta::{$method}($parent, self::GUID2, new ArrayFormat()) :
            Meta::{$method}(self::GUID2, new ArrayFormat());
        $expected = [
            'href' => Url::API . '/' . $expectedPath . '/' . self::GUID2,
            'type' => $expectedType,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expected, $meta);
    }

    private function assertMetaMethodWithoutGuidWorks(string $method, string $expectedPath, string $expectedType, ObjectInterface|string|array $parent): void
    {
        $meta = $parent ?
            Meta::{$method}($parent, new ArrayFormat()) :
            Meta::{$method}(new ArrayFormat());
        $expected = [
            'href' => Url::API . '/' . $expectedPath,
            'type' => $expectedType,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expected, $meta);
    }
}
