<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CommissionReportOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CounterpartyAdjustment;
use Evgeek\Moysklad\Api\Record\Objects\Documents\CustomerOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Enter;
use Evgeek\Moysklad\Api\Record\Objects\Documents\InternalOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Inventory;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PaymentOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PrepaymentReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\ProcessingOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseOrder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\PurchaseReturn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashIn;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailDrawerCashOut;
use Evgeek\Moysklad\Api\Record\Objects\Documents\SalesReturn;
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
use Evgeek\Moysklad\Api\Record\Objects\Nested\State;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Type;

class ObjectBuilder extends AbstractBuilder
{
    /**
     * Создаёт объект неизвестной сущности. Используется для не реализованных в библиотеке сущностей.
     *
     * <code>
     * $product = $ms->object()
     *  ->single()
     *  ->unknown(['entity', 'product', '1958e4df-f7ca-11ed-0a80-030500578f19'], 'product');
     * </code>
     */
    public function unknown(array $path, string $type, mixed $content = []): UnknownObject
    {
        return new UnknownObject($this->ms, $path, $type, $content);
    }

    /**
     * Бонусная операция
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
     *
     * @return BonusTransaction
     */
    public function bonustransaction(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::BONUSTRANSACTION, $content);
    }

    /**
     * Бонусная программа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
     *
     * @return BonusProgram
     */
    public function bonusprogram(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::BONUSPROGRAM, $content);
    }

    /**
     * Валюта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
     *
     * @return Currency
     */
    public function currency(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CURRENCY, $content);
    }

    /**
     * Вебхук
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
     *
     * @return Webhook
     */
    public function webhook(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::WEBHOOK, $content);
    }

    /**
     * Вебхук на изменение остатков
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
     *
     * @return WebhookStock
     */
    public function webhookstock(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::WEBHOOKSTOCK, $content);
    }

    /**
     * Группа товаров
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
     *
     * @return ProductFolder
     */
    public function productfolder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PRODUCTFOLDER, $content);
    }

    /**
     * Договор
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
     *
     * @return Contract
     */
    public function contract(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CONTRACT, $content);
    }

    /**
     * Единица измерения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
     *
     * @return Uom
     */
    public function uom(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::UOM, $content);
    }

    /**
     * Задача
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
     *
     * @return Task
     */
    public function task(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::TASK, $content);
    }

    /**
     * Изображение
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
     *
     * @return Image
     */
    public function image(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::IMAGE, $parent, $content);
    }

    /**
     * Канал продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
     *
     * @return SalesChannel
     */
    public function saleschannel(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::SALESCHANNEL, $content);
    }

    /**
     * Кассир
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     *
     * @return Cashier
     */
    public function cashier(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::CASHIER, $parent, $content);
    }

    /**
     * Комплект
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
     *
     * @return Bundle
     */
    public function bundle(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::BUNDLE, $content);
    }

    /**
     * Контрагент
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
     *
     * @return Counterparty
     */
    public function counterparty(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::COUNTERPARTY, $content);
    }

    /**
     * Модификация
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
     *
     * @return Variant
     */
    public function variant(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::VARIANT, $content);
    }

    /**
     * Настройки компании
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii
     *
     * @return CompanySettings
     */
    public function companysettings(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::COMPANYSETTINGS, $content);
    }

    /**
     * Настройки пользователя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-pol-zowatelq
     *
     * @return UserSettings
     */
    public function usersettings(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::USERSETTINGS, $content);
    }

    /**
     * Отдел
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
     *
     * @return Group
     */
    public function group(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::GROUP, $content);
    }

    /**
     * Подписка компании
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-podpiska-kompanii
     *
     * @return Subscription
     */
    public function subscription(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::SUBSCRIPTION, $content);
    }

    /**
     * Пользовательская роль
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
     *
     * @return CustomRole
     */
    public function role(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CUSTOMROLE, $content);
    }

    /**
     * Пользовательский справочник
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
     *
     * @return CustomEntity
     */
    public function customentity(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CUSTOMENTITY, $content);
    }

    /**
     * Проект
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-proekt
     *
     * @return Project
     */
    public function project(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PROJECT, $content);
    }

    /**
     * Регион
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
     *
     * @return Region
     */
    public function region(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::REGION, $content);
    }

    /**
     * Серия
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
     *
     * @return Consignment
     */
    public function consignment(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CONSIGNMENT, $content);
    }

    /**
     * Накопительная скидка
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return AccumulationDiscount
     */
    public function accumulationdiscount(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::ACCUMULATIONDISCOUNT, $content);
    }

    /**
     * Персональная скидка
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return PersonalDiscount
     */
    public function personaldiscount(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PERSONALDISCOUNT, $content);
    }

    /**
     * Специальная цена
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     *
     * @return SpecialPriceDiscount
     */
    public function specialpricediscount(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::SPECIALPRICEDISCOUNT, $content);
    }

    /**
     * Склад
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
     *
     * @return Store
     */
    public function store(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::STORE, $content);
    }

    /**
     * Сотрудник
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     *
     * @return Employee
     */
    public function employee(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::EMPLOYEE, $content);
    }

    /**
     * Сохраненный фильтр
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
     *
     * @return NamedFilter
     */
    public function namedfilter(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::NAMEDFILTER, $parent, $content);
    }

    /**
     * Ставка НДС
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
     *
     * @return TaxRate
     */
    public function taxrate(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::TAXRATE, $content);
    }

    /**
     * Статусы документов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
     *
     * @return State
     */
    public function state(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::STATE, $parent, $content);
    }

    /**
     * Статья расходов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
     *
     * @return ExpenseItem
     */
    public function expenseitem(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::EXPENSEITEM, $content);
    }

    /**
     * Страна
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
     *
     * @return Country
     */
    public function country(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::COUNTRY, $content);
    }

    /**
     * Техкарта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
     *
     * @return ProcessingPlan
     */
    public function processingplan(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PROCESSINGPLAN, $content);
    }

    /**
     * Этап Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
     *
     * @return ProcessingPlanStages
     */
    public function processingplanstages(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::PROCESSINGPLANSTAGES, $parent, $content);
    }

    /**
     * Материал Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-material-tehkarty
     *
     * @return ProcessingPlanMaterial
     */
    public function processingplanmaterial(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::PROCESSINGPLANMATERIAL, $parent, $content);
    }

    /**
     * Продукт Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
     *
     * @return ProcessingPlanResult
     */
    public function processingplanresult(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::PROCESSINGPLANRESULT, $parent, $content);
    }

    /**
     * Техпроцесс
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
     *
     * @return ProcessingProcess
     */
    public function processingprocess(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PROCESSINGPROCESS, $content);
    }

    /**
     * Тип цен
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
     *
     * @return PriceType
     */
    public function pricetype(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PRICETYPE, $content);
    }

    /**
     * Товар
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     *
     * @return Product
     */
    public function product(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PRODUCT, $content);
    }

    /**
     * Точка продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     *
     * @return RetailStore
     */
    public function retailstore(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::RETAILSTORE, $content);
    }

    /**
     * Услуга
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
     *
     * @return Service
     */
    public function service(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::SERVICE, $content);
    }

    /**
     * Файл
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
     *
     * @return Files
     */
    public function files(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::FILES, $parent, $content);
    }

    /**
     * Характеристика модификации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
     *
     * @return AttributeMetadata
     */
    public function attributemetadata(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::ATTRIBUTEMETADATA, $content);
    }

    /**
     * Стандартный шаблон
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-standartnyh-shablonow
     *
     * @return EmbeddedTemplate
     */
    public function embeddedtemplate(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::EMBEDDEDTEMPLATE, $parent, $content);
    }

    /**
     * Пользовательский шаблон
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-pol-zowatel-skih-shablonow
     *
     * @return CustomTemplate
     */
    public function customtemplate(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::CUSTOMTEMPLATE, $parent, $content);
    }

    /**
     * Юрлицо
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
     *
     * @return Organization
     */
    public function organization(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::ORGANIZATION, $content);
    }

    /**
     * Счёт юрлица
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico-scheta-urlica
     *
     * @return Account
     */
    public function account(ObjectInterface|array|string $parent, mixed $content = []): AbstractNestedObject
    {
        return $this->resolveNestedObject(Type::ACCOUNT, $parent, $content);
    }

    /**
     * Этап производства
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
     *
     * @return ProcessingStage
     */
    public function processingstage(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PROCESSINGSTAGE, $content);
    }

    /**
     * Внесение денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnesenie-deneg
     *
     * @return RetailDrawerCashIn
     */
    public function retaildrawercashin(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::RETAILDRAWERCASHIN, $content);
    }

    /**
     * Внутренний заказ
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnutrennij-zakaz
     *
     * @return InternalOrder
     */
    public function internalorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::INTERNALORDER, $content);
    }

    /**
     * Возврат покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
     *
     * @return SalesReturn
     */
    public function salesreturn(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::SALESRETURN, $content);
    }

    /**
     * Возврат поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
     *
     * @return PurchaseReturn
     */
    public function purchasereturn(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PURCHASERETURN, $content);
    }

    /**
     * Возврат предоплаты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
     *
     * @return PrepaymentReturn
     */
    public function prepaymentreturn(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PREPAYMENTRETURN, $content);
    }

    /**
     * Входящий платеж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
     *
     * @return PaymentIn
     */
    public function paymentin(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PAYMENTIN, $content);
    }

    /**
     * Выданный отчет комиссионера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vydannyj-otchet-komissionera
     *
     * @return CommissionReportOut
     */
    public function commissionreportout(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::COMMISSIONREPORTOUT, $content);
    }

    /**
     * Выплата денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
     *
     * @return RetailDrawerCashOut
     */
    public function retaildrawercashout(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::RETAILDRAWERCASHOUT, $content);
    }

    /**
     * Заказ на производство
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-na-proizwodstwo
     *
     * @return ProcessingOrder
     */
    public function processingorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PROCESSINGORDER, $content);
    }

    /**
     * Заказ покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     *
     * @return CustomerOrder
     */
    public function customerorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::CUSTOMERORDER, $content);
    }

    /**
     * Заказ поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-postawschiku
     *
     * @return PurchaseOrder
     */
    public function purchaseorder(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PURCHASEORDER, $content);
    }

    /**
     * Инвентаризация
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
     *
     * @return Inventory
     */
    public function inventory(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::INVENTORY, $content);
    }

    /**
     * Исходящий платеж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-ishodqschij-platezh
     *
     * @return PaymentOut
     */
    public function paymentout(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::PAYMENTOUT, $content);
    }

    /**
     * Корректировка баланса контрагента
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
     *
     * @return CounterpartyAdjustment
     */
    public function counterpartyadjustment(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::COUNTERPARTYADJUSTMENT, $content);
    }

    /**
     * Оприходование
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
     *
     * @return Enter
     */
    public function enter(mixed $content = []): AbstractConcreteObject
    {
        return $this->resolveObject(Type::ENTER, $content);
    }
}
