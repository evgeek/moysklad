<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
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
use Evgeek\Moysklad\Api\Record\Collections\Entities\CustomTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\DiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmbeddedTemplateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ExpenseItemCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\FilesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\GroupCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PersonalDiscountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\PriceTypeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingPlanCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProcessingProcessCollection;
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
use Evgeek\Moysklad\Api\Record\Collections\Nested\CashierCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ImageCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\NamedFilterCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanMaterialCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanResultCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\ProcessingPlanStagesCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\StateCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\TrackingCodeCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Dictionaries\Type;

class CollectionBuilder extends AbstractBuilder
{
    /**
     * Создаёт неизвестную коллекцию. Используется для не реализованных в библиотеке коллекций.
     *
     * <code>
     * $productCollection = $ms->object()->collection()->unknown(['entity', 'product'], 'product');
     * </code>
     */
    public function unknown(array $path, string $type): UnknownCollection
    {
        return new UnknownCollection($this->ms, $path, $type);
    }

    /**
     * Коллекция Ассортиментов (Товары, Услуги, Комплекты, Серии и Модификаци).
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     *
     * @return AssortmentCollection
     */
    public function assortment(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::ASSORTMENT);
    }

    /**
     * Коллекция Бонусных операций.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
     *
     * @return BonusTransactionCollection
     */
    public function bonustransaction(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::BONUSTRANSACTION);
    }

    /**
     * Коллекция Бонусных программм.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
     *
     * @return BonusProgramCollection
     */
    public function bonusprogram(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::BONUSPROGRAM);
    }

    /**
     * Коллекция Валют.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
     *
     * @return CurrencyCollection
     */
    public function currency(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CURRENCY);
    }

    /**
     * Коллекция Вебхуков.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
     *
     * @return WebhookCollection
     */
    public function webhook(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::WEBHOOK);
    }

    /**
     * Коллекция Вебхуков на изменение остатков.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
     *
     * @return WebhookStockCollection
     */
    public function webhookstock(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::WEBHOOKSTOCK);
    }

    /**
     * Коллекция Групп товаров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
     *
     * @return ProductFolderCollection
     */
    public function productfolder(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PRODUCTFOLDER);
    }

    /**
     * Коллекция Договоров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
     *
     * @return ContractCollection
     */
    public function contract(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CONTRACT);
    }

    /**
     * Коллекция Единиц измерения.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
     *
     * @return UomCollection
     */
    public function uom(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::UOM);
    }

    /**
     * Коллекция Задач.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
     *
     * @return TaskCollection
     */
    public function task(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::TASK);
    }

    /**
     * Коллекция Изображений.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
     *
     * @return ImageCollection
     */
    public function image(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::IMAGE, $parent);
    }

    /**
     * Коллекция Каналов продаж.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
     *
     * @return SalesChannelCollection
     */
    public function saleschannel(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::SALESCHANNEL);
    }

    /**
     * Коллекция Кассиров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     *
     * @return CashierCollection
     */
    public function cashier(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::CASHIER, $parent);
    }

    /**
     * Коллекция Кодов маркировки.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kody-markirowki
     *
     * @return TrackingCodeCollection
     */
    public function trackingcode(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::TRACKINGCODE, $parent);
    }

    /**
     * Коллекция Комплектов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
     *
     * @return BundleCollection
     */
    public function bundle(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::BUNDLE);
    }

    /**
     * Коллекция Контрагентов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
     *
     * @return CounterpartyCollection
     */
    public function counterparty(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::COUNTERPARTY);
    }

    /**
     * Коллекция Модификаций.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
     *
     * @return VariantCollection
     */
    public function variant(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::VARIANT);
    }

    /**
     * Коллекция Отделов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
     *
     * @return GroupCollection
     */
    public function group(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::GROUP);
    }

    /**
     * Коллекция Пользовательских ролей.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
     *
     * @return CustomRoleCollection
     */
    public function role(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CUSTOMROLE);
    }

    /**
     * Коллекция Пользовательских справочников.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
     *
     * @return CustomEntityCollection
     */
    public function customentity(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CUSTOMENTITY);
    }

    /**
     * Коллекция Проектов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-proekt
     *
     * @return ProjectCollection
     */
    public function project(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PROJECT);
    }

    /**
     * Коллекция Регионов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
     *
     * @return RegionCollection
     */
    public function region(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::REGION);
    }

    /**
     * Коллекция Серий.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
     *
     * @return ConsignmentCollection
     */
    public function consignment(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CONSIGNMENT);
    }

    /**
     * Коллекция Скидкок.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return DiscountCollection
     */
    public function discount(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::DISCOUNT);
    }

    /**
     * Коллекция Накопительных скидок.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return AccumulationDiscountCollection
     */
    public function accumulationdiscount(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::ACCUMULATIONDISCOUNT);
    }

    /**
     * Коллекция Персональных скидок.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return PersonalDiscountCollection
     */
    public function personaldiscount(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PERSONALDISCOUNT);
    }

    /**
     * Коллекция Специальных цен.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return SpecialPriceDiscountCollection
     */
    public function specialpricediscount(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::SPECIALPRICEDISCOUNT);
    }

    /**
     * Коллекция Складов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
     *
     * @return StoreCollection
     */
    public function store(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::STORE);
    }

    /**
     * Коллекция Сотрудников.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     *
     * @return EmployeeCollection
     */
    public function employee(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::EMPLOYEE);
    }

    /**
     * Коллекция Сохраненных фильтров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
     *
     * @return NamedFilterCollection
     */
    public function namedfilter(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::NAMEDFILTER, $parent);
    }

    /**
     * Коллекция Ставок НДС.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
     *
     * @return TaxRateCollection
     */
    public function taxrate(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::TAXRATE);
    }

    /**
     * Коллекция Статусов документов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
     *
     * @return StateCollection
     */
    public function state(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::STATE, $parent);
    }

    /**
     * Коллекция Статей расходов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
     *
     * @return ExpenseItemCollection
     */
    public function expenseitem(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::EXPENSEITEM);
    }

    /**
     * Коллекция Стран.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
     *
     * @return CountryCollection
     */
    public function country(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::COUNTRY);
    }

    /**
     * Коллекция Техкарт.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
     *
     * @return ProcessingPlanCollection
     */
    public function processingplan(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PROCESSINGPLAN);
    }

    /**
     * Коллекция Этапов Техкарты.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
     *
     * @return ProcessingPlanStagesCollection
     */
    public function processingplanstages(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::PROCESSINGPLANSTAGES, $parent);
    }

    /**
     * Коллекция Материалов Техкарты.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-material-tehkarty
     *
     * @return ProcessingPlanMaterialCollection
     */
    public function processingplanmaterial(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::PROCESSINGPLANMATERIAL, $parent);
    }

    /**
     * Коллекция Продуктов Техкарты.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
     *
     * @return ProcessingPlanResultCollection
     */
    public function processingplanresult(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::PROCESSINGPLANRESULT, $parent);
    }

    /**
     * Коллекция Техпроцессов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
     *
     * @return ProcessingProcessCollection
     */
    public function processingprocess(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PROCESSINGPROCESS);
    }

    /**
     * Коллекция Типов цен.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
     *
     * @return PriceTypeCollection
     */
    public function pricetype(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PRICETYPE);
    }

    /**
     * Коллекция Товаров.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     *
     * @return ProductCollection
     */
    public function product(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::PRODUCT);
    }
    /**
     * Коллекция Точек продаж.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     *
     * @return RetailStoreCollection
     */
    public function retailstore(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::RETAILSTORE);
    }

    /**
     * Коллекция Услуг.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
     *
     * @return ServiceCollection
     */
    public function service(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::SERVICE);
    }

    /**
     * Коллекция Файлов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
     *
     * @return FilesCollection
     */
    public function files(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::FILES, $parent);
    }

    /**
     * Коллекция Характеристик модификации.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
     *
     * @return AttributeMetadataCollection
     */
    public function attributemetadata(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::ATTRIBUTEMETADATA);
    }

    /**
     * Коллекция Стандартных шаблонов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-standartnyh-shablonow
     *
     * @return EmbeddedTemplateCollection
     */
    public function embeddedtemplate(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::EMBEDDEDTEMPLATE, $parent);
    }

    /**
     * Коллекция Пользовательских шаблонов.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-pol-zowatel-skih-shablonow
     *
     * @return CustomTemplateCollection
     */
    public function customtemplate(ObjectInterface|array|string $parent): AbstractNestedCollection
    {
        return $this->resolveNestedCollection(Type::CUSTOMTEMPLATE, $parent);
    }








    /**
     * Коллекция Заказов покупателя.
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     *
     * @return CustomerOrderCollection
     */
    public function customerorder(): AbstractConcreteCollection
    {
        return $this->resolveCollection(Type::CUSTOMERORDER);
    }
}
