<?php

namespace Evgeek\Tests\Unit\Meta;

use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Organization;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Meta\MetaBuilder */
class MetaBuilderTest extends TestCase
{
    private const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    private const GUID2 = 'f731148b-a93d-11ed-0a80-0fba0011a6c6';

    private MoySklad $ms;

    protected function setUp(): void
    {
        $this->ms = new MoySklad(['token'], new ArrayFormat());
    }

    /** @dataProvider creationDataProvider */
    public function testCreationMethod(string $method, array $params, string $expectedPath, string $expectedType): void
    {
        $expectedMeta = [
            'href' => Url::API . $expectedPath,
            'type' => $expectedType,
            'mediaType' => 'application/json',
        ];
        $this->assertSame($expectedMeta, $this->ms->meta()->{$method}(...$params));
    }

    public static function creationDataProvider(): array
    {
        $ms = new MoySklad(['']);

        $parentProduct = Product::make($ms, ['id' => self::GUID1]);
        $parentCounterparty = Counterparty::make($ms, ['id' => self::GUID1]);
        $parentProcessingPlan = ProcessingPlan::make($ms, ['id' => self::GUID1]);

        return [
            'create' => ['create', [['segment1', 'segment2'], 'type'], '/segment1/segment2', 'type'],
            Type::BONUSTRANSACTION => ['bonustransaction', [self::GUID1], '/entity/bonustransaction/' . self::GUID1, 'bonustransaction'],
            Type::BONUSPROGRAM => ['bonusprogram', [self::GUID1], '/entity/bonusprogram/' . self::GUID1, 'bonusprogram'],
            Type::CURRENCY => ['currency', [self::GUID1], '/entity/currency/' . self::GUID1, 'currency'],
            Type::WEBHOOK => ['webhook', [self::GUID1], '/entity/webhook/' . self::GUID1, 'webhook'],
            Type::WEBHOOKSTOCK => ['webhookstock', [self::GUID1], '/entity/webhookstock/' . self::GUID1, 'webhookstock'],
            Type::PRODUCTFOLDER => ['productfolder', [self::GUID1], '/entity/productfolder/' . self::GUID1, 'productfolder'],
            Type::CONTRACT => ['contract', [self::GUID1], '/entity/contract/' . self::GUID1, 'contract'],
            Type::UOM => ['uom', [self::GUID1], '/entity/uom/' . self::GUID1, 'uom'],
            Type::TASK => ['task', [self::GUID1], '/entity/task/' . self::GUID1, 'task'],
            Type::IMAGE => ['image', [$parentProduct, self::GUID2], '/entity/product/' . self::GUID1 . '/images/' . self::GUID2, 'image'],
            Type::SALESCHANNEL => ['saleschannel', [self::GUID1], '/entity/saleschannel/' . self::GUID1, 'saleschannel'],
            Type::CASHIER => ['cashier', [$parentProduct, self::GUID2], '/entity/product/' . self::GUID1 . '/cashiers/' . self::GUID2, 'cashier'],
            Type::BUNDLE => ['bundle', [self::GUID1], '/entity/bundle/' . self::GUID1, 'bundle'],
            Type::COUNTERPARTY => ['counterparty', [self::GUID1], '/entity/counterparty/' . self::GUID1, 'counterparty'],
            Type::VARIANT => ['variant', [self::GUID1], '/entity/variant/' . self::GUID1, 'variant'],
            Type::COMPANYSETTINGS => ['companysettings', [], '/context/companysettings', 'companysettings'],
            Type::USERSETTINGS => ['usersettings', [], '/context/usersettings', 'usersettings'],
            Type::GROUP => ['group', [self::GUID1], '/entity/group/' . self::GUID1, 'group'],
            Type::CUSTOMROLE => ['role', [self::GUID1], '/entity/role/' . self::GUID1, 'customrole'],
            Type::CUSTOMENTITY => ['customentity', [self::GUID1], '/entity/customentity/' . self::GUID1, 'customentity'],
            Type::PROJECT => ['project', [self::GUID1], '/entity/project/' . self::GUID1, 'project'],
            Type::REGION => ['region', [self::GUID1], '/entity/region/' . self::GUID1, 'region'],
            Type::CONSIGNMENT => ['consignment', [self::GUID1], '/entity/consignment/' . self::GUID1, 'consignment'],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', [self::GUID1], '/entity/accumulationdiscount/' . self::GUID1, 'accumulationdiscount'],
            Type::PERSONALDISCOUNT => ['personaldiscount', [self::GUID1], '/entity/personaldiscount/' . self::GUID1, 'personaldiscount'],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', [self::GUID1], '/entity/specialpricediscount/' . self::GUID1, 'specialpricediscount'],
            Type::STORE => ['store', [self::GUID1], '/entity/store/' . self::GUID1, 'store'],
            Type::EMPLOYEE => ['employee', [self::GUID1], '/entity/employee/' . self::GUID1, 'employee'],
            Type::NAMEDFILTER => ['namedfilter', [['entity', 'product'], self::GUID1], '/entity/product/namedfilter/' . self::GUID1, 'namedfilter'],
            Type::TAXRATE => ['taxrate', [self::GUID1], '/entity/taxrate/' . self::GUID1, 'taxrate'],
            Type::STATE => ['state', ['counterparty', self::GUID1], '/entity/counterparty/metadata/states/' . self::GUID1, 'state'],
            Type::EXPENSEITEM => ['expenseitem', [self::GUID1], '/entity/expenseitem/' . self::GUID1, 'expenseitem'],
            Type::COUNTRY => ['country', [self::GUID1], '/entity/country/' . self::GUID1, 'country'],
            Type::PROCESSINGPLAN => ['processingplan', [self::GUID1], '/entity/processingplan/' . self::GUID1, 'processingplan'],
            Type::PROCESSINGPLANSTAGES => ['processingplanstages', [$parentProcessingPlan, self::GUID2], '/entity/processingplan/' . self::GUID1 . '/stages/' . self::GUID2, 'processingplanstages'],
            Type::PROCESSINGPLANMATERIAL => ['processingplanmaterial', [$parentProcessingPlan, self::GUID2], '/entity/processingplan/' . self::GUID1 . '/materials/' . self::GUID2, 'processingplanmaterial'],
            Type::PROCESSINGPLANRESULT => ['processingplanresult', [$parentProcessingPlan, self::GUID2], '/entity/processingplan/' . self::GUID1 . '/products/' . self::GUID2, 'processingplanresult'],
            Type::PROCESSINGPROCESS => ['processingprocess', [self::GUID1], '/entity/processingprocess/' . self::GUID1, 'processingprocess'],
            Type::PRICETYPE => ['pricetype', [self::GUID1], '/context/companysettings/pricetype/' . self::GUID1, 'pricetype'],
            Type::PRODUCT => ['product', [self::GUID1], '/entity/product/' . self::GUID1, 'product'],
            Type::RETAILSTORE => ['retailstore', [self::GUID1], '/entity/retailstore/' . self::GUID1, 'retailstore'],
            Type::SERVICE => ['service', [self::GUID1], '/entity/service/' . self::GUID1, 'service'],
            Type::FILES => ['files', [$parentCounterparty, self::GUID2], '/entity/counterparty/' . self::GUID1 . '/files/' . self::GUID2, 'files'],
            Type::ATTRIBUTEMETADATA => ['attributemetadata', [self::GUID1], '/entity/variant/metadata/characteristics/' . self::GUID1, 'attributemetadata'],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', [Counterparty::make($ms), self::GUID2], '/entity/counterparty/metadata/embeddedtemplate/' . self::GUID2, 'embeddedtemplate'],
            Type::CUSTOMTEMPLATE => ['customtemplate', [Counterparty::make($ms), self::GUID2], '/entity/counterparty/metadata/customtemplate/' . self::GUID2, 'customtemplate'],
            Type::ORGANIZATION => ['organization', [self::GUID1], '/entity/organization/' . self::GUID1, 'organization'],
            Type::ACCOUNT => ['account', [Organization::make($ms, ['id' => self::GUID1]), self::GUID2], '/entity/organization/' . self::GUID1 . '/accounts/' . self::GUID2, 'account'],
            Type::PROCESSINGSTAGE => ['processingstage', [self::GUID1], '/entity/processingstage/' . self::GUID1, 'processingstage'],

            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', [self::GUID1], '/entity/retaildrawercashin/' . self::GUID1, 'retaildrawercashin'],
            Type::INTERNALORDER => ['internalorder', [self::GUID1], '/entity/internalorder/' . self::GUID1, 'internalorder'],
            Type::SALESRETURN => ['salesreturn', [self::GUID1], '/entity/salesreturn/' . self::GUID1, 'salesreturn'],
            Type::PURCHASERETURN => ['purchasereturn', [self::GUID1], '/entity/purchasereturn/' . self::GUID1, 'purchasereturn'],
            Type::PREPAYMENTRETURN => ['prepaymentreturn', [self::GUID1], '/entity/prepaymentreturn/' . self::GUID1, 'prepaymentreturn'],

            Type::CUSTOMERORDER => ['customerorder', [self::GUID1], '/entity/customerorder/' . self::GUID1, 'customerorder'],
        ];
    }
}
