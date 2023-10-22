<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\CollectionInterface;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\InternalOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\RetailDrawerCashInCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\SalesReturnCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AccumulationDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AssortmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AttributeMetadataCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusProgramCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BonusTransactionCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BundleCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ConsignmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ContractCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CounterpartyCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CountryCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CurrencyCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomEntityCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomRoleCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\DiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ExpenseItemCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\GroupCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\OrganizationCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PersonalDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PriceTypeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingPlanCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingProcessCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingStageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductFolderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProjectCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\RegionCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\RetailStoreCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\SalesChannelCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ServiceCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\SpecialPriceDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\StoreCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\TaskCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\TaxRateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\UomCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\VariantCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookStockCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\AccountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\CashierCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\CustomTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\EmbeddedTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\FilesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ImageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\NamedFilterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanMaterialCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanResultCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanStagesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\TrackingCodeCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InternalOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
use Evgeek\Moysklad\Api\Record\Objects\Entities\AccumulationDiscount;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Assortment;
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
use Evgeek\Moysklad\Api\Record\Objects\Entities\Discount;
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
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Api\Record\Objects\Nested\TrackingCode;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Type;
use InvalidArgumentException;

class RecordMapping
{
    protected const DEFAULT_MAPPING_OBJECTS = [
        Type::ASSORTMENT => Assortment::class,
        Type::BONUSTRANSACTION => BonusTransaction::class,
        Type::BONUSPROGRAM => BonusProgram::class,
        Type::CURRENCY => Currency::class,
        Type::WEBHOOK => Webhook::class,
        Type::WEBHOOKSTOCK => WebhookStock::class,
        Type::PRODUCTFOLDER => ProductFolder::class,
        Type::CONTRACT => Contract::class,
        Type::UOM => Uom::class,
        Type::TASK => Task::class,
        Type::IMAGE => Image::class,
        Type::SALESCHANNEL => SalesChannel::class,
        Type::CASHIER => Cashier::class,
        Type::TRACKINGCODE => TrackingCode::class,
        Type::BUNDLE => Bundle::class,
        Type::COUNTERPARTY => Counterparty::class,
        Type::VARIANT => Variant::class,
        Type::COMPANYSETTINGS => CompanySettings::class,
        Type::USERSETTINGS => UserSettings::class,
        Type::GROUP => Group::class,
        Type::SUBSCRIPTION => Subscription::class,
        Type::CUSTOMROLE => CustomRole::class,
        Type::CUSTOMENTITY => CustomEntity::class,
        Type::PROJECT => Project::class,
        Type::REGION => Region::class,
        Type::CONSIGNMENT => Consignment::class,
        Type::DISCOUNT => Discount::class,
        Type::ACCUMULATIONDISCOUNT => AccumulationDiscount::class,
        Type::PERSONALDISCOUNT => PersonalDiscount::class,
        Type::SPECIALPRICEDISCOUNT => SpecialPriceDiscount::class,
        Type::STORE => Store::class,
        Type::EMPLOYEE => Employee::class,
        Type::NAMEDFILTER => NamedFilter::class,
        Type::TAXRATE => TaxRate::class,
        Type::STATE => State::class,
        Type::EXPENSEITEM => ExpenseItem::class,
        Type::COUNTRY => Country::class,
        Type::PROCESSINGPLAN => ProcessingPlan::class,
        Type::PROCESSINGPLANSTAGES => ProcessingPlanStages::class,
        Type::PROCESSINGPLANMATERIAL => ProcessingPlanMaterial::class,
        Type::PROCESSINGPLANRESULT => ProcessingPlanResult::class,
        Type::PROCESSINGPROCESS => ProcessingProcess::class,
        Type::PRICETYPE => PriceType::class,
        Type::PRODUCT => Product::class,
        Type::RETAILSTORE => RetailStore::class,
        Type::SERVICE => Service::class,
        Type::FILES => Files::class,
        Type::ATTRIBUTEMETADATA => AttributeMetadata::class,
        Type::EMBEDDEDTEMPLATE => EmbeddedTemplate::class,
        Type::CUSTOMTEMPLATE => CustomTemplate::class,
        Type::ORGANIZATION => Organization::class,
        Type::ACCOUNT => Account::class,
        Type::PROCESSINGSTAGE => ProcessingStage::class,

        Type::RETAILDRAWERCASHIN => RetailDrawerCashIn::class,
        Type::INTERNALORDER => InternalOrder::class,
        Type::SALESRETURN => SalesReturn::class,

        Type::CUSTOMERORDER => CustomerOrder::class,
    ];
    protected const DEFAULT_MAPPING_COLLECTIONS = [
        Type::ASSORTMENT => AssortmentCollection::class,
        Type::BONUSTRANSACTION => BonusTransactionCollection::class,
        Type::BONUSPROGRAM => BonusProgramCollection::class,
        Type::CURRENCY => CurrencyCollection::class,
        Type::WEBHOOK => WebhookCollection::class,
        Type::WEBHOOKSTOCK => WebhookStockCollection::class,
        Type::PRODUCTFOLDER => ProductFolderCollection::class,
        Type::CONTRACT => ContractCollection::class,
        Type::UOM => UomCollection::class,
        Type::TASK => TaskCollection::class,
        Type::IMAGE => ImageCollection::class,
        Type::SALESCHANNEL => SalesChannelCollection::class,
        Type::CASHIER => CashierCollection::class,
        Type::TRACKINGCODE => TrackingCodeCollection::class,
        Type::BUNDLE => BundleCollection::class,
        Type::COUNTERPARTY => CounterpartyCollection::class,
        Type::VARIANT => VariantCollection::class,
        Type::GROUP => GroupCollection::class,
        Type::CUSTOMROLE => CustomRoleCollection::class,
        Type::CUSTOMENTITY => CustomEntityCollection::class,
        Type::PROJECT => ProjectCollection::class,
        Type::REGION => RegionCollection::class,
        Type::CONSIGNMENT => ConsignmentCollection::class,
        Type::DISCOUNT => DiscountCollection::class,
        Type::ACCUMULATIONDISCOUNT => AccumulationDiscountCollection::class,
        Type::PERSONALDISCOUNT => PersonalDiscountCollection::class,
        Type::SPECIALPRICEDISCOUNT => SpecialPriceDiscountCollection::class,
        Type::STORE => StoreCollection::class,
        Type::EMPLOYEE => EmployeeCollection::class,
        Type::NAMEDFILTER => NamedFilterCollection::class,
        Type::TAXRATE => TaxRateCollection::class,
        Type::STATE => StateCollection::class,
        Type::EXPENSEITEM => ExpenseItemCollection::class,
        Type::COUNTRY => CountryCollection::class,
        Type::PROCESSINGPLAN => ProcessingPlanCollection::class,
        Type::PROCESSINGPLANSTAGES => ProcessingPlanStagesCollection::class,
        Type::PROCESSINGPLANMATERIAL => ProcessingPlanMaterialCollection::class,
        Type::PROCESSINGPLANRESULT => ProcessingPlanResultCollection::class,
        Type::PROCESSINGPROCESS => ProcessingProcessCollection::class,
        Type::PRICETYPE => PriceTypeCollection::class,
        Type::PRODUCT => ProductCollection::class,
        Type::RETAILSTORE => RetailStoreCollection::class,
        Type::SERVICE => ServiceCollection::class,
        Type::FILES => FilesCollection::class,
        Type::ATTRIBUTEMETADATA => AttributeMetadataCollection::class,
        Type::EMBEDDEDTEMPLATE => EmbeddedTemplateCollection::class,
        Type::CUSTOMTEMPLATE => CustomTemplateCollection::class,
        Type::ORGANIZATION => OrganizationCollection::class,
        Type::ACCOUNT => AccountCollection::class,
        Type::PROCESSINGSTAGE => ProcessingStageCollection::class,

        Type::RETAILDRAWERCASHIN => RetailDrawerCashInCollection::class,
        Type::INTERNALORDER => InternalOrderCollection::class,
        Type::SALESRETURN => SalesReturnCollection::class,

        Type::CUSTOMERORDER => CustomerOrderCollection::class,
    ];

    protected array $objects = self::DEFAULT_MAPPING_OBJECTS;
    protected array $collections = self::DEFAULT_MAPPING_COLLECTIONS;

    public function __construct(?array $objects = null, ?array $collections = null)
    {
        if (null !== $objects) {
            $this->objects = $objects;
        }
        if (null !== $collections) {
            $this->collections = $collections;
        }
    }

    /**
     * @param class-string<AbstractConcreteObject>|list<class-string<AbstractConcreteObject>> $class
     */
    public function setObject(array|string $class): static
    {
        $this->set($this->objects, $class, [
            AbstractConcreteObject::class,
            AbstractNestedObject::class,
        ]);

        return $this;
    }

    /**
     * @param class-string<AbstractConcreteCollection>|list<class-string<AbstractConcreteCollection>> $class
     */
    public function setCollection(array|string $class): static
    {
        $this->set($this->collections, $class, [
            AbstractConcreteCollection::class,
            AbstractNestedCollection::class,
        ]);

        return $this;
    }

    /**
     * @return class-string<ObjectInterface>
     */
    public function getObject(string $type): string
    {
        return $this->get($this->objects, $type, [
            AbstractConcreteObject::class,
            AbstractNestedObject::class,
        ]) ?? UnknownObject::class;
    }

    /**
     * @return class-string<CollectionInterface>
     */
    public function getCollection(string $type): string
    {
        return $this->get($this->collections, $type, [
            AbstractConcreteCollection::class,
            AbstractNestedCollection::class,
        ]) ?? UnknownCollection::class;
    }

    /** @param class-string<AbstractConcreteRecord>|list<class-string<AbstractConcreteRecord>> $class */
    protected function set(array &$property, array|string $class, array $expectedClasses): void
    {
        if (is_array($class)) {
            foreach ($class as $nestedClass) {
                $this->set($property, $nestedClass, $expectedClasses);
            }

            return;
        }

        $type = $class::TYPE;
        if (is_string($class)) {
            $this->validateClassIs($class, $expectedClasses);
            $property[$type] = $class;

            return;
        }
    }

    protected function validateClassIs(string $class, array $expectedClasses): void
    {
        $validated = false;
        $expectedClassesString = '';
        foreach ($expectedClasses as $expectedClass) {
            if (is_a($class, $expectedClass, true)) {
                $validated = true;
            }

            $expectedClassesString .= $expectedClassesString === '' ? "[$expectedClass" : ", $expectedClass";
        }
        $expectedClassesString .= ']';

        if (!$validated) {
            throw new InvalidArgumentException("$class is not in $expectedClassesString");
        }
    }

    private function get(array $property,string $type, array $expectedClasses): ?string
    {
        if (!array_key_exists($type, $property)) {
            return null;
        }

        $class = $property[$type];
        $this->validateClassIs($class, $expectedClasses);

        return $class;
    }
}
