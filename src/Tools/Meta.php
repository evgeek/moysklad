<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Tools;

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
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Formatters\StdClassFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\NestedRecordHelper;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

class Meta
{
    /** @deprecated */
    private static ?JsonFormatterInterface $formatter = null;

    /**
     * Метаданные Бонусной операции
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
     */
    public static function bonustransaction(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...BonusTransaction::PATH, $guid], BonusTransaction::TYPE, $formatter);
    }

    /**
     * Метаданные Бонусной программы
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
     */
    public static function bonusprogram(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...BonusProgram::PATH, $guid], BonusProgram::TYPE, $formatter);
    }

    /**
     * Метаданные Валюты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
     */
    public static function currency(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Currency::PATH, $guid], Currency::TYPE, $formatter);
    }

    /**
     * Метаданные Вебхука
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
     */
    public static function webhook(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Webhook::PATH, $guid], Webhook::TYPE, $formatter);
    }

    /**
     * Метаданные Вебхука на изменение остатков
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
     */
    public static function webhookstock(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...WebhookStock::PATH, $guid], WebhookStock::TYPE, $formatter);
    }

    /**
     * Метаданные Группы товаров
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
     */
    public static function productfolder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ProductFolder::PATH, $guid], ProductFolder::TYPE, $formatter);
    }

    /**
     * Метаданные Договора
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
     */
    public static function contract(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Contract::PATH, $guid], Contract::TYPE, $formatter);
    }

    /**
     * Метаданные Единицы измерения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
     */
    public static function uom(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Uom::PATH, $guid], Uom::TYPE, $formatter);
    }

    /**
     * Метаданные Изображения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
     */
    public static function image(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...Image::PATH, $guid], Image::TYPE, $formatter);
    }

    /**
     * Метаданные Задачи
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
     */
    public static function task(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Task::PATH, $guid], Task::TYPE, $formatter);
    }

    /**
     * Метаданные Канала продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
     */
    public static function saleschannel(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...SalesChannel::PATH, $guid], SalesChannel::TYPE, $formatter);
    }

    /**
     * Метаданные Кассира
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     */
    public static function cashier(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...Cashier::PATH, $guid], Cashier::TYPE, $formatter);
    }

    /**
     * Метаданные Комплекта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
     */
    public static function bundle(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Bundle::PATH, $guid], Bundle::TYPE, $formatter);
    }

    /**
     * Метаданные Контрагента
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
     */
    public static function counterparty(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Counterparty::PATH, $guid], Counterparty::TYPE, $formatter);
    }

    /**
     * Метаданные Модификации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
     */
    public static function variant(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Variant::PATH, $guid], Variant::TYPE, $formatter);
    }

    /**
     * Метаданные Настроек компании
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii
     */
    public static function companysettings(JsonFormatterInterface $formatter = null)
    {
        return static::create(CompanySettings::PATH, CompanySettings::TYPE, $formatter);
    }

    /**
     * Метаданные Настроек пользователя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-pol-zowatelq
     */
    public static function usersettings(JsonFormatterInterface $formatter = null)
    {
        return static::create(UserSettings::PATH, UserSettings::TYPE, $formatter);
    }

    /**
     * Метаданные Отдела
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
     */
    public static function group(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Group::PATH, $guid], Group::TYPE, $formatter);
    }

    /**
     * Метаданные Пользовательской роли
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
     */
    public static function role(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...CustomRole::PATH, $guid], CustomRole::TYPE, $formatter);
    }

    /**
     * Метаданные Пользовательского справочника
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
     */
    public static function customentity(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...CustomEntity::PATH, $guid], CustomEntity::TYPE, $formatter);
    }

    /**
     * Метаданные Проекта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-proekt
     */
    public static function project(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Project::PATH, $guid], Project::TYPE, $formatter);
    }

    /**
     * Метаданные Региона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
     */
    public static function region(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Region::PATH, $guid], Region::TYPE, $formatter);
    }

    /**
     * Метаданные Серии
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
     */
    public static function consignment(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Consignment::PATH, $guid], Consignment::TYPE, $formatter);
    }

    /**
     * Метаданные Накопительной скидки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public static function accumulationdiscount(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...AccumulationDiscount::PATH, $guid], AccumulationDiscount::TYPE, $formatter);
    }

    /**
     * Метаданные Персональной скидки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public static function personaldiscount(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PersonalDiscount::PATH, $guid], PersonalDiscount::TYPE, $formatter);
    }

    /**
     * Метаданные Специальной цены
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public static function specialpricediscount(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...SpecialPriceDiscount::PATH, $guid], SpecialPriceDiscount::TYPE, $formatter);
    }

    /**
     * Метаданные Склада
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
     */
    public static function store(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Store::PATH, $guid], Store::TYPE, $formatter);
    }

    /**
     * Метаданные Сотрудника
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     */
    public static function employee(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Employee::PATH, $guid], Employee::TYPE, $formatter);
    }

    /**
     * Метаданные Сохраненного фильтра
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
     */
    public static function namedfilter(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...NamedFilter::PATH, $guid], NamedFilter::TYPE, $formatter);
    }

    /**
     * Метаданные Ставки НДС
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
     */
    public static function taxrate(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...TaxRate::PATH, $guid], TaxRate::TYPE, $formatter);
    }

    /**
     * Метаданные Статуса документов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
     */
    public static function state(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...State::PATH, $guid], State::TYPE, $formatter);
    }

    /**
     * Метаданные Статьи расходов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
     */
    public static function expenseitem(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ExpenseItem::PATH, $guid], ExpenseItem::TYPE, $formatter);
    }

    /**
     * Метаданные Страны
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
     */
    public static function country(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Country::PATH, $guid], Country::TYPE, $formatter);
    }

    /**
     * Метаданные Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
     */
    public static function processingplan(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ProcessingPlan::PATH, $guid], ProcessingPlan::TYPE, $formatter);
    }

    /**
     * Метаданные Этапа Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
     */
    public static function processingplanstages(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...ProcessingPlanStages::PATH, $guid], ProcessingPlanStages::TYPE, $formatter);
    }

    /**
     * Метаданные Материала Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-material-tehkarty
     */
    public static function processingplanmaterial(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...ProcessingPlanMaterial::PATH, $guid], ProcessingPlanMaterial::TYPE, $formatter);
    }

    /**
     * Метаданные Продукта Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
     */
    public static function processingplanresult(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...ProcessingPlanResult::PATH, $guid], ProcessingPlanResult::TYPE, $formatter);
    }

    /**
     * Метаданные Техпроцесса
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
     */
    public static function processingprocess(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ProcessingProcess::PATH, $guid], ProcessingProcess::TYPE, $formatter);
    }

    /**
     * Метаданные Типа цены
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
     */
    public static function pricetype(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PriceType::PATH, $guid], PriceType::TYPE, $formatter);
    }

    /**
     * Метаданные Товара
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public static function product(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Product::PATH, $guid], Product::TYPE, $formatter);
    }

    /**
     * Метаданные Точки продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     */
    public static function retailstore(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...RetailStore::PATH, $guid], RetailStore::TYPE, $formatter);
    }

    /**
     * Метаданные Услуги
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
     */
    public static function service(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Service::PATH, $guid], Service::TYPE, $formatter);
    }

    /**
     * Метаданные Файла
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
     */
    public static function files(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...Files::PATH, $guid], Files::TYPE, $formatter);
    }

    /**
     * Метаданные Характеристики модификации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
     */
    public static function attributemetadata(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...AttributeMetadata::PATH, $guid], AttributeMetadata::TYPE, $formatter);
    }

    /**
     * Метаданные Стандартного шаблона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-standartnyh-shablonow
     */
    public static function embeddedtemplate(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...EmbeddedTemplate::PATH, $guid], EmbeddedTemplate::TYPE, $formatter);
    }

    /**
     * Метаданные Пользовательского шаблона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-pol-zowatel-skih-shablonow
     */
    public static function customtemplate(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...CustomTemplate::PATH, $guid], CustomTemplate::TYPE, $formatter);
    }

    /**
     * Метаданные Юрлица
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
     */
    public static function organization(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Organization::PATH, $guid], Organization::TYPE, $formatter);
    }

    /**
     * Метаданные Счёта юрлица
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico-scheta-urlica
     */
    public static function account(ObjectInterface|array|string $parent, string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::createNested($parent, [...Account::PATH, $guid], Account::TYPE, $formatter);
    }

    /**
     * Метаданные Этапа производства
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
     */
    public static function processingstage(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ProcessingStage::PATH, $guid], ProcessingStage::TYPE, $formatter);
    }

    /**
     * Метаданные Внесения денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnesenie-deneg
     */
    public static function retaildrawercashin(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...RetailDrawerCashIn::PATH, $guid], RetailDrawerCashIn::TYPE, $formatter);
    }

    /**
     * Метаданные Внутреннего заказа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnutrennij-zakaz
     */
    public static function internalorder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...InternalOrder::PATH, $guid], InternalOrder::TYPE, $formatter);
    }

    /**
     * Метаданные Возврата покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
     */
    public static function salesreturn(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...SalesReturn::PATH, $guid], SalesReturn::TYPE, $formatter);
    }

    /**
     * Метаданные Возврата поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
     */
    public static function purchasereturn(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PurchaseReturn::PATH, $guid], PurchaseReturn::TYPE, $formatter);
    }

    /**
     * Метаданные Возврата предоплаты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
     */
    public static function prepaymentreturn(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PrepaymentReturn::PATH, $guid], PrepaymentReturn::TYPE, $formatter);
    }

    /**
     * Метаданные Входящего платежа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
     */
    public static function paymentin(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PaymentIn::PATH, $guid], PaymentIn::TYPE, $formatter);
    }

    /**
     * Метаданные Выданного отчета комиссионера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vydannyj-otchet-komissionera
     */
    public static function commissionreportout(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...CommissionReportOut::PATH, $guid], CommissionReportOut::TYPE, $formatter);
    }

    /**
     * Метаданные Выплаты денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
     */
    public static function retaildrawercashout(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...RetailDrawerCashOut::PATH, $guid], RetailDrawerCashOut::TYPE, $formatter);
    }

    /**
     * Метаданные Заказа на производство
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-na-proizwodstwo
     */
    public static function processingorder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...ProcessingOrder::PATH, $guid], ProcessingOrder::TYPE, $formatter);
    }

    /**
     * Метаданные Заказа покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public static function customerorder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...CustomerOrder::PATH, $guid], CustomerOrder::TYPE, $formatter);
    }

    /**
     * Метаданные Заказа поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-postawschiku
     */
    public static function purchaseorder(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PurchaseOrder::PATH, $guid], PurchaseOrder::TYPE, $formatter);
    }

    /**
     * Метаданные Инвентаризации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
     */
    public static function inventory(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Inventory::PATH, $guid], Inventory::TYPE, $formatter);
    }

    /**
     * Метаданные Исходящего платежа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-ishodqschij-platezh
     */
    public static function paymentout(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...PaymentOut::PATH, $guid], PaymentOut::TYPE, $formatter);
    }

    /**
     * Метаданные Корректировки баланса контрагента
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
     */
    public static function counterpartyadjustment(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...CounterpartyAdjustment::PATH, $guid], CounterpartyAdjustment::TYPE, $formatter);
    }

    /**
     * Метаданные Оприходования
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
     */
    public static function enter(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Enter::PATH, $guid], Enter::TYPE, $formatter);
    }

    /**
     * Метаданные Отгрузки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
     */
    public static function demand(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Demand::PATH, $guid], Demand::TYPE, $formatter);
    }

    /**
     * Метаданные Перемещения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-peremeschenie
     */
    public static function move(string $guid, JsonFormatterInterface $formatter = null)
    {
        return static::create([...Move::PATH, $guid], Move::TYPE, $formatter);
    }











    /** @deprecated */
    public static function entity(array $path, string $type, JsonFormatterInterface $formatter = null)
    {
        return static::create([Segment::ENTITY, ...$path], $type, $formatter);
    }

    /**
     * Метаданные неизвестной сущности
     *
     * <code>
     * $productMeta = Meta::create(['entity', 'product'], 'product');
     * </code>
     *
     * @param string[] $path
     */
    public static function create(array $path, string $type, JsonFormatterInterface $formatter = null)
    {
        $formatter = $formatter ?? static::$formatter ?? new StdClassFormat();

        return $formatter->encode((new ArrayFormat())->decode([
            'href' => static::makeHref($path),
            'type' => $type,
            'mediaType' => 'application/json',
        ]));
    }

    /**
     * Метаданные неизвестной вложенной сущности.
     *
     * <code>
     * $parent = ['entity', 'product']; //Или Product::make($ms), 'product', Product::class
     * $productFiltersMeta = Meta::createNested($parent, ['namedfilter'], 'namedfilter');
     * </code>
     *
     * @param string[] $path
     */
    public static function createNested(
        ObjectInterface|array|string $parent,
        array $path,
        string $type,
        JsonFormatterInterface $formatter = null
    ) {
        $ms = $formatter ? new MoySklad([''], $formatter) : new MoySklad(['']);
        $fullPath = [...NestedRecordHelper::getParentPath($ms, $parent), ...$path];

        return static::create($fullPath, $type, $formatter);
    }

    /**
     * @deprecated
     */
    public static function setFormat(JsonFormatterInterface $formatter): void
    {
        static::$formatter = $formatter;
    }

    private static function makeHref(array $path): string
    {
        $href = Url::API;
        $path = array_values($path);
        foreach ($path as $key => $segment) {
            if (!is_string($segment)) {
                throw new InvalidArgumentException("{$key}th segment of path is not a string");
            }
            $href .= "/$segment";
        }

        return $href;
    }
}
