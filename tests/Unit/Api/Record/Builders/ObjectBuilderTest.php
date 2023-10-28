<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Builders\ObjectBuilder;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CounterpartyAdjustment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Demand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Enter;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InternalOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Move;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Prepayment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PrepaymentReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PriceList;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDemand;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Supply;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AccumulationDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AttributeMetadata;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusProgram;
use Evgeek\Moysklad\Api\Record\Objects\Entities\BonusTransaction;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Bundle;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CompanySettings;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Consignment;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Contract;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Counterparty;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Country;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Currency;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomEntity;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomRole;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ExpenseItem;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Group;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Organization;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PersonalDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\PriceType;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingPlan;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingProcess;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProcessingStage;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\Entities\ProductFolder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Project;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Region;
use Evgeek\Moysklad\Api\Record\Objects\Entities\RetailStore;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SalesChannel;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Service;
use Evgeek\Moysklad\Api\Record\Objects\Entities\SpecialPriceDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Store;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Subscription;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Task;
use Evgeek\Moysklad\Api\Record\Objects\Entities\TaxRate;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Uom;
use Evgeek\Moysklad\Api\Record\Objects\Entities\UserSettings;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Variant;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Webhook;
use Evgeek\Moysklad\Api\Record\Objects\Entities\WebhookStock;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Account;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Cashier;
use Evgeek\Moysklad\Api\Record\Objects\Nested\CustomTemplate;
use Evgeek\Moysklad\Api\Record\Objects\Nested\EmbeddedTemplate;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Files;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Image;
use Evgeek\Moysklad\Api\Record\Objects\Nested\NamedFilter;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanMaterial;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanResult;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ProcessingPlanStages;
use Evgeek\Moysklad\Api\Record\Objects\Nested\ReturnToCommissionerPosition;
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Api\Record\Objects\Nested\TrackingCode;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Type;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Record\Builders\ObjectBuilder
 */
class ObjectBuilderTest extends RecordResolversTestCase
{
    private ObjectBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new ObjectBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $mapping = new RecordMapping([], []);
        $ms = new MoySklad(['token'], new RecordFormat($mapping));
        $builder = new ObjectBuilder($ms);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Object type 'product' has no mapped class");

        $builder->product();
    }

    public function testUnknownMethod(): void
    {
        $path = ['endpoint', 'segment'];
        $type = 'unknown_type';
        $unknown = $this->builder->unknown($path, $type, static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($unknown, UnknownObject::class, $path, $type);
    }

    /**
     * @param class-string<AbstractConcreteObject> $expectedSegment
     *
     * @dataProvider methodsWithCorrespondingObjectClass
     */
    public function testMethodReturnsCorrectClass(string $method, string $expectedSegment, bool $isNested = false): void
    {
        $expectedClass = $isNested ? AbstractNestedObject::class : AbstractConcreteObject::class;
        $object = $isNested ?
            $this->builder->{$method}(['endpoint', 'segment'], static::CONTENT) :
            $this->builder->{$method}(static::CONTENT);

        $this->assertInstanceOf($expectedClass, $object);
        $this->assertObjectResolvedWithExpectedMetaAndContent($object, $expectedSegment);

        $path = $isNested ?
            ['endpoint', 'segment', ...$object::PATH] :
            $object::PATH;
        $expectedHref = Url::makeFromPathAndParams($path);
        $this->assertSame($expectedHref, $object->meta->href);
    }

    public static function methodsWithCorrespondingObjectClass(): array
    {
        return [
            Type::BONUSTRANSACTION => ['bonustransaction', BonusTransaction::class],
            Type::BONUSPROGRAM => ['bonusprogram', BonusProgram::class],
            Type::CURRENCY => ['currency', Currency::class],
            Type::WEBHOOK => ['webhook', Webhook::class],
            Type::WEBHOOKSTOCK => ['webhookstock', WebhookStock::class],
            Type::PRODUCTFOLDER => ['productfolder', ProductFolder::class],
            Type::CONTRACT => ['contract', Contract::class],
            Type::UOM => ['uom', Uom::class],
            Type::TASK => ['task', Task::class],
            Type::IMAGE => ['image', Image::class, true],
            Type::SALESCHANNEL => ['saleschannel', SalesChannel::class],
            Type::CASHIER => ['cashier', Cashier::class, true],
            Type::BUNDLE => ['bundle', Bundle::class],
            Type::COUNTERPARTY => ['counterparty', Counterparty::class],
            Type::VARIANT => ['variant', Variant::class],
            Type::COMPANYSETTINGS => ['companysettings', CompanySettings::class],
            Type::USERSETTINGS => ['usersettings', UserSettings::class],
            Type::GROUP => ['group', Group::class],
            Type::SUBSCRIPTION => ['subscription', Subscription::class],
            Type::CUSTOMROLE => ['role', CustomRole::class],
            Type::CUSTOMENTITY => ['customentity', CustomEntity::class],
            Type::PROJECT => ['project', Project::class],
            Type::REGION => ['region', Region::class],
            Type::CONSIGNMENT => ['consignment', Consignment::class],
            Type::ACCUMULATIONDISCOUNT => ['accumulationdiscount', AccumulationDiscount::class],
            Type::PERSONALDISCOUNT => ['personaldiscount', PersonalDiscount::class],
            Type::SPECIALPRICEDISCOUNT => ['specialpricediscount', SpecialPriceDiscount::class],
            Type::STORE => ['store', Store::class],
            Type::EMPLOYEE => ['employee', Employee::class],
            Type::NAMEDFILTER => ['namedfilter', NamedFilter::class, true],
            Type::TAXRATE => ['taxrate', TaxRate::class],
            Type::STATE => ['state', State::class, true],
            Type::EXPENSEITEM => ['expenseitem', ExpenseItem::class],
            Type::COUNTRY => ['country', Country::class],
            Type::PROCESSINGPLAN => ['processingplan', ProcessingPlan::class],
            Type::PROCESSINGPLANSTAGES => ['processingplanstages', ProcessingPlanStages::class, true],
            Type::PROCESSINGPLANMATERIAL => ['processingplanmaterial', ProcessingPlanMaterial::class, true],
            Type::PROCESSINGPLANRESULT => ['processingplanresult', ProcessingPlanResult::class, true],
            Type::PROCESSINGPROCESS => ['processingprocess', ProcessingProcess::class],
            Type::PRICETYPE => ['pricetype', PriceType::class],
            Type::PRODUCT => ['product', Product::class],
            Type::RETAILSTORE => ['retailstore', RetailStore::class],
            Type::SERVICE => ['service', Service::class],
            Type::FILES => ['files', Files::class, true],
            Type::ATTRIBUTEMETADATA => ['attributemetadata', AttributeMetadata::class],
            Type::EMBEDDEDTEMPLATE => ['embeddedtemplate', EmbeddedTemplate::class, true],
            Type::CUSTOMTEMPLATE => ['customtemplate', CustomTemplate::class, true],
            Type::ORGANIZATION => ['organization', Organization::class],
            Type::ACCOUNT => ['account', Account::class, true],
            Type::PROCESSINGSTAGE => ['processingstage', ProcessingStage::class],
            Type::RETAILDRAWERCASHIN => ['retaildrawercashin', RetailDrawerCashIn::class],
            Type::INTERNALORDER => ['internalorder', InternalOrder::class],
            Type::SALESRETURN => ['salesreturn', SalesReturn::class],
            Type::PURCHASERETURN => ['purchasereturn', PurchaseReturn::class],
            Type::PREPAYMENTRETURN => ['prepaymentreturn', PrepaymentReturn::class],
            Type::PAYMENTIN => ['paymentin', PaymentIn::class],
            Type::COMMISSIONREPORTOUT => ['commissionreportout', CommissionReportOut::class],
            Type::RETAILDRAWERCASHOUT => ['retaildrawercashout', RetailDrawerCashOut::class],
            Type::PROCESSINGORDER => ['processingorder', ProcessingOrder::class],
            Type::CUSTOMERORDER => ['customerorder', CustomerOrder::class],
            Type::PURCHASEORDER => ['purchaseorder', PurchaseOrder::class],
            Type::INVENTORY => ['inventory', Inventory::class],
            Type::PAYMENTOUT => ['paymentout', PaymentOut::class],
            Type::COUNTERPARTYADJUSTMENT => ['counterpartyadjustment', CounterpartyAdjustment::class],
            Type::ENTER => ['enter', Enter::class],
            Type::DEMAND => ['demand', Demand::class],
            Type::MOVE => ['move', Move::class],
            Type::RETURNTOCOMMISSIONERPOSITION => ['returntocommissionerposition', ReturnToCommissionerPosition::class, true],
            Type::COMMISSIONREPORTIN => ['commissionreportin', CommissionReportIn::class],
            Type::PRICELIST => ['pricelist', PriceList::class],
            Type::PREPAYMENT => ['prepayment', Prepayment::class],
            Type::SUPPLY => ['supply', Supply::class],
            Type::CASHIN => ['cashin', CashIn::class],
            Type::CASHOUT => ['cashout', CashOut::class],
            Type::RETAILDEMAND => ['retaildemand', RetailDemand::class],
        ];
    }
}
