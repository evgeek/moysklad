<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Query\Segments\Endpoints;

use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CashInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CashOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CommissionReportInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CommissionReportOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CounterpartyAdjustmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\CustomerOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\DemandSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\EnterSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\FactureInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\FactureOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InternalOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InventorySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InvoiceInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\InvoiceOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\LossSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\MoveSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PaymentInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PaymentOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PrepaymentReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PrepaymentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PriceListSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\ProcessingOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\ProcessingSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PurchaseOrderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\PurchaseReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDemandSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDrawerCashInSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailDrawerCashOutSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailSalesReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\RetailShiftSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\SalesReturnSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Documents\SupplySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AccumulationDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\AssortmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BonusProgramSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BonusTransactionSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\BundleSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ConsignmentSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ContractSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CounterpartySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CountrySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CurrencySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\CustomEntitySegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\DiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\EmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ExpenseItemSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\GroupSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\OrganizationSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\PersonalDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingPlanSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingProcessSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProcessingStageSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductFolderSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProductSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ProjectSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RegionSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RetailStoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\RoleSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\SalesChannelSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\ServiceSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\SpecialPriceDiscountSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\StoreSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\TaskSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\TaxRateSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\UomSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\VariantSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\WebhookSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\Entities\WebhookStockSegment;
use Evgeek\Moysklad\Api\Query\Traits\Segments\MetadataTrait;
use Evgeek\Moysklad\Api\Record\Objects\Documents\RetailSalesReturn;
use Evgeek\Moysklad\Dictionaries\Segment;

class EntitySegment extends AbstractNamedSegment
{
    use MetadataTrait;

    protected const SEGMENT = Segment::ENTITY;

    /**
     * Ассортимент
     *
     * <code>
     * $assortments = $ms->query()
     *  ->entity()
     *  ->assortment()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-assortiment
     */
    public function assortment(): AssortmentSegment
    {
        return $this->resolveNamedBuilder(AssortmentSegment::class);
    }

    /**
     * Бонусная операция
     *
     * <code>
     * $bonusTransactions = $ms->query()
     *  ->entity()
     *  ->bonustransaction()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
     */
    public function bonustransaction(): BonusTransactionSegment
    {
        return $this->resolveNamedBuilder(BonusTransactionSegment::class);
    }

    /**
     * Бонусная программа
     *
     * <code>
     * $bonusPrograms = $ms->query()
     *  ->entity()
     *  ->bonusprogram()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
     */
    public function bonusprogram(): BonusProgramSegment
    {
        return $this->resolveNamedBuilder(BonusProgramSegment::class);
    }

    /**
     * Валюта
     *
     * <code>
     * $currencies = $ms->query()
     *  ->entity()
     *  ->currency()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
     */
    public function currency(): CurrencySegment
    {
        return $this->resolveNamedBuilder(CurrencySegment::class);
    }

    /**
     * Вебхуки
     *
     * <code>
     * $webhooks = $ms->query()
     *  ->entity()
     *  ->webhook()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
     */
    public function webhook(): WebhookSegment
    {
        return $this->resolveNamedBuilder(WebhookSegment::class);
    }

    /**
     * Вебхук на изменение остатков
     *
     * <code>
     * $webhookStocks = $ms->query()
     *  ->entity()
     *  ->webhookstock()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
     */
    public function webhookstock(): WebhookStockSegment
    {
        return $this->resolveNamedBuilder(WebhookStockSegment::class);
    }

    /**
     * Группа товаров
     *
     * <code>
     * $productFolders = $ms->query()
     *  ->entity()
     *  ->productfolder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
     */
    public function productfolder(): ProductFolderSegment
    {
        return $this->resolveNamedBuilder(ProductFolderSegment::class);
    }

    /**
     * Договор
     *
     * <code>
     * $contracts = $ms->query()
     *  ->entity()
     *  ->contract()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
     */
    public function contract(): ContractSegment
    {
        return $this->resolveNamedBuilder(ContractSegment::class);
    }

    /**
     * Единица измерения
     *
     * <code>
     * $uoms = $ms->query()
     *  ->entity()
     *  ->uom()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
     */
    public function uom(): UomSegment
    {
        return $this->resolveNamedBuilder(UomSegment::class);
    }

    /**
     * Задача
     *
     * <code>
     * $tasks = $ms->query()
     *  ->entity()
     *  ->task()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
     */
    public function task(): TaskSegment
    {
        return $this->resolveNamedBuilder(TaskSegment::class);
    }

    /**
     * Канал продаж
     *
     * <code>
     * $salesChannels = $ms->query()
     *  ->entity()
     *  ->saleschannel()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
     */
    public function saleschannel(): SalesChannelSegment
    {
        return $this->resolveNamedBuilder(SalesChannelSegment::class);
    }

    /**
     * Комплект
     *
     * <code>
     * $bundles = $ms->query()
     *  ->entity()
     *  ->bundle()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
     */
    public function bundle(): BundleSegment
    {
        return $this->resolveNamedBuilder(BundleSegment::class);
    }

    /**
     * Контрагент
     *
     * <code>
     * $counterparties = $ms->query()
     *  ->entity()
     *  ->counterparty()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
     */
    public function counterparty(): CounterpartySegment
    {
        return $this->resolveNamedBuilder(CounterpartySegment::class);
    }

    /**
     * Модификация
     *
     * <code>
     * $variants = $ms->query()
     *  ->entity()
     *  ->variant()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
     */
    public function variant(): VariantSegment
    {
        return $this->resolveNamedBuilder(VariantSegment::class);
    }

    /**
     * Отдел
     *
     * <code>
     * $groups = $ms->query()
     *  ->entity()
     *  ->group()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
     */
    public function group(): GroupSegment
    {
        return $this->resolveNamedBuilder(GroupSegment::class);
    }

    /**
     * Пользовательские роли
     *
     * <code>
     * $roles = $ms->query()
     *  ->entity()
     *  ->role()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
     */
    public function role(): RoleSegment
    {
        return $this->resolveNamedBuilder(RoleSegment::class);
    }

    /**
     * Пользовательский справочник
     *
     * <code>
     * $customEntities = $ms->query()
     *  ->entity()
     *  ->customentity()
     *  ->create(['name' => "custom dictionary"]);
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
     */
    public function customentity(): CustomEntitySegment
    {
        return $this->resolveNamedBuilder(CustomEntitySegment::class);
    }

    /**
     * Проект
     *
     * <code>
     * $projects = $ms->query()
     *  ->entity()
     *  ->project()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-proekt
     */
    public function project(): ProjectSegment
    {
        return $this->resolveNamedBuilder(ProjectSegment::class);
    }

    /**
     * Регион
     *
     * <code>
     * $regions = $ms->query()
     *  ->entity()
     *  ->region()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
     */
    public function region(): RegionSegment
    {
        return $this->resolveNamedBuilder(RegionSegment::class);
    }

    /**
     * Серия
     *
     * <code>
     * $consignments = $ms->query()
     *  ->entity()
     *  ->consignment()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
     */
    public function consignment(): ConsignmentSegment
    {
        return $this->resolveNamedBuilder(ConsignmentSegment::class);
    }

    /**
     * Скидки
     *
     * <code>
     * $discounts = $ms->query()
     *  ->entity()
     *  ->discount()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function discount(): DiscountSegment
    {
        return $this->resolveNamedBuilder(DiscountSegment::class);
    }

    /**
     * Накопительные скидки
     *
     * <code>
     * $accumulationDiscounts = $ms->query()
     *  ->entity()
     *  ->accumulationdiscount()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function accumulationdiscount(): AccumulationDiscountSegment
    {
        return $this->resolveNamedBuilder(AccumulationDiscountSegment::class);
    }

    /**
     * Персональные скидки
     *
     * <code>
     * $personalDiscounts = $ms->query()
     *  ->entity()
     *  ->personaldiscount()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function personaldiscount(): PersonalDiscountSegment
    {
        return $this->resolveNamedBuilder(PersonalDiscountSegment::class);
    }

    /**
     * Специальные цены
     *
     * <code>
     * $specialPriceDiscounts = $ms->query()
     *  ->entity()
     *  ->specialpricediscount()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function specialpricediscount(): SpecialPriceDiscountSegment
    {
        return $this->resolveNamedBuilder(SpecialPriceDiscountSegment::class);
    }

    /**
     * Склад
     *
     * <code>
     * $stores = $ms->query()
     *  ->entity()
     *  ->store()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
     */
    public function store(): StoreSegment
    {
        return $this->resolveNamedBuilder(StoreSegment::class);
    }

    /**
     * Сотрудник
     *
     * <code>
     * $employees = $ms->query()
     *  ->entity()
     *  ->employee()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     */
    public function employee(): EmployeeSegment
    {
        return $this->resolveNamedBuilder(EmployeeSegment::class);
    }

    /**
     * Ставка НДС
     *
     * <code>
     * $taxRates = $ms->query()
     *  ->entity()
     *  ->taxrate()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
     */
    public function taxrate(): TaxRateSegment
    {
        return $this->resolveNamedBuilder(TaxRateSegment::class);
    }

    /**
     * Статья расходов
     *
     * <code>
     * $expenseItems = $ms->query()
     *  ->entity()
     *  ->expenseitem()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
     */
    public function expenseitem(): ExpenseItemSegment
    {
        return $this->resolveNamedBuilder(ExpenseItemSegment::class);
    }

    /**
     * Страна
     *
     * <code>
     * $countries = $ms->query()
     *  ->entity()
     *  ->country()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
     */
    public function country(): CountrySegment
    {
        return $this->resolveNamedBuilder(CountrySegment::class);
    }

    /**
     * Техкарта
     *
     * <code>
     * $processingPlans = $ms->query()
     *  ->entity()
     *  ->processingplan()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
     */
    public function processingplan(): ProcessingPlanSegment
    {
        return $this->resolveNamedBuilder(ProcessingPlanSegment::class);
    }

    /**
     * Техпроцесс
     *
     * <code>
     * $processingProcesses = $ms->query()
     *  ->entity()
     *  ->processingprocess()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
     */
    public function processingprocess(): ProcessingProcessSegment
    {
        return $this->resolveNamedBuilder(ProcessingProcessSegment::class);
    }

    /**
     * Товар
     *
     * <code>
     * $products = $ms->query()
     *  ->entity()
     *  ->product()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function product(): ProductSegment
    {
        return $this->resolveNamedBuilder(ProductSegment::class);
    }

    /**
     * Точка продаж
     *
     * <code>
     * $retailStores = $ms->query()
     *  ->entity()
     *  ->retailstore()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     */
    public function retailstore(): RetailStoreSegment
    {
        return $this->resolveNamedBuilder(RetailStoreSegment::class);
    }

    /**
     * Услуга
     *
     * <code>
     * $services = $ms->query()
     *  ->entity()
     *  ->service()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
     */
    public function service(): ServiceSegment
    {
        return $this->resolveNamedBuilder(ServiceSegment::class);
    }

    /**
     * Юрлицо
     *
     * <code>
     * $organizations = $ms->query()
     *  ->entity()
     *  ->organization()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
     */
    public function organization(): OrganizationSegment
    {
        return $this->resolveNamedBuilder(OrganizationSegment::class);
    }

    /**
     * Этап производства
     *
     * <code>
     * $processingStages = $ms->query()
     *  ->entity()
     *  ->processingstage()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
     */
    public function processingstage(): ProcessingStageSegment
    {
        return $this->resolveNamedBuilder(ProcessingStageSegment::class);
    }

    /**
     * Внесение денег
     *
     * <code>
     * $retailDrawerCashIns = $ms->query()
     *  ->entity()
     *  ->retaildrawercashin()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnesenie-deneg
     */
    public function retaildrawercashin(): RetailDrawerCashInSegment
    {
        return $this->resolveNamedBuilder(RetailDrawerCashInSegment::class);
    }

    /**
     * Внутренний заказ
     *
     * <code>
     * $internalOrders = $ms->query()
     *  ->entity()
     *  ->internalorder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnutrennij-zakaz
     */
    public function internalorder(): InternalOrderSegment
    {
        return $this->resolveNamedBuilder(InternalOrderSegment::class);
    }

    /**
     * Возврат покупателя
     *
     * <code>
     * $salesReturns = $ms->query()
     *  ->entity()
     *  ->salesreturn()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
     */
    public function salesreturn(): SalesReturnSegment
    {
        return $this->resolveNamedBuilder(SalesReturnSegment::class);
    }

    /**
     * Возврат поставщику
     *
     * <code>
     * $purchaseReturns = $ms->query()
     *  ->entity()
     *  ->purchasereturn()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
     */
    public function purchasereturn(): PurchaseReturnSegment
    {
        return $this->resolveNamedBuilder(PurchaseReturnSegment::class);
    }

    /**
     * Возврат предоплаты
     *
     * <code>
     * $prepaymentReturns = $ms->query()
     *  ->entity()
     *  ->prepaymentreturn()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
     */
    public function prepaymentreturn(): PrepaymentReturnSegment
    {
        return $this->resolveNamedBuilder(PrepaymentReturnSegment::class);
    }

    /**
     * Входящий платеж
     *
     * <code>
     * $paymentIn = $ms->query()
     *  ->entity()
     *  ->paymentin()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
     */
    public function paymentin(): PaymentInSegment
    {
        return $this->resolveNamedBuilder(PaymentInSegment::class);
    }

    /**
     * Выданный отчет комиссионера
     *
     * <code>
     * $commissionReportOuts = $ms->query()
     *  ->entity()
     *  ->commissionreportout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vydannyj-otchet-komissionera
     */
    public function commissionreportout(): CommissionReportOutSegment
    {
        return $this->resolveNamedBuilder(CommissionReportOutSegment::class);
    }

    /**
     * Выплата денег
     *
     * <code>
     * $retailDrawerCashOuts = $ms->query()
     *  ->entity()
     *  ->retaildrawercashout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
     */
    public function retaildrawercashout(): RetailDrawerCashOutSegment
    {
        return $this->resolveNamedBuilder(RetailDrawerCashOutSegment::class);
    }

    /**
     * Заказ на производство
     *
     * <code>
     * $processingOrders = $ms->query()
     *  ->entity()
     *  ->processingorder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-na-proizwodstwo
     */
    public function processingorder(): ProcessingOrderSegment
    {
        return $this->resolveNamedBuilder(ProcessingOrderSegment::class);
    }

    /**
     * Заказ покупателя
     *
     * <code>
     * $customerOrders = $ms->query()
     *  ->entity()
     *  ->customerorder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public function customerorder(): CustomerOrderSegment
    {
        return $this->resolveNamedBuilder(CustomerOrderSegment::class);
    }

    /**
     * Заказ поставщику
     *
     * <code>
     * $purchaseOrders = $ms->query()
     *  ->entity()
     *  ->purchaseorder()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-postawschiku
     */
    public function purchaseorder(): PurchaseOrderSegment
    {
        return $this->resolveNamedBuilder(PurchaseOrderSegment::class);
    }

    /**
     * Инвентаризация
     *
     * <code>
     * $inventories = $ms->query()
     *  ->entity()
     *  ->inventory()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
     */
    public function inventory(): InventorySegment
    {
        return $this->resolveNamedBuilder(InventorySegment::class);
    }

    /**
     * Исходящий платеж
     *
     * <code>
     * $paymentOuts = $ms->query()
     *  ->entity()
     *  ->paymentout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-ishodqschij-platezh
     */
    public function paymentout(): PaymentOutSegment
    {
        return $this->resolveNamedBuilder(PaymentOutSegment::class);
    }

    /**
     * Корректировка баланса контрагента
     *
     * <code>
     * $counterpartyAdjustments = $ms->query()
     *  ->entity()
     *  ->counterpartyadjustment()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
     */
    public function counterpartyadjustment(): CounterpartyAdjustmentSegment
    {
        return $this->resolveNamedBuilder(CounterpartyAdjustmentSegment::class);
    }

    /**
     * Оприходование
     *
     * <code>
     * $enters = $ms->query()
     *  ->entity()
     *  ->enter()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
     */
    public function enter(): EnterSegment
    {
        return $this->resolveNamedBuilder(EnterSegment::class);
    }

    /**
     * Отгрузка
     *
     * <code>
     * $demands = $ms->query()
     *  ->entity()
     *  ->demand()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
     */
    public function demand(): DemandSegment
    {
        return $this->resolveNamedBuilder(DemandSegment::class);
    }

    /**
     * Перемещение
     *
     * <code>
     * $moves = $ms->query()
     *  ->entity()
     *  ->move()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-peremeschenie
     */
    public function move(): MoveSegment
    {
        return $this->resolveNamedBuilder(MoveSegment::class);
    }

    /**
     * Полученный отчет комиссионера
     *
     * <code>
     * $commissionReportIns = $ms->query()
     *  ->entity()
     *  ->commissionreportin()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera
     */
    public function commissionreportin(): CommissionReportInSegment
    {
        return $this->resolveNamedBuilder(CommissionReportInSegment::class);
    }

    /**
     * Прайс-лист
     *
     * <code>
     * $priceLists = $ms->query()
     *  ->entity()
     *  ->pricelist()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prajs-list
     */
    public function pricelist(): PriceListSegment
    {
        return $this->resolveNamedBuilder(PriceListSegment::class);
    }

    /**
     * Предоплата
     *
     * <code>
     * $prepayments = $ms->query()
     *  ->entity()
     *  ->prepayment()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-predoplata
     */
    public function prepayment(): PrepaymentSegment
    {
        return $this->resolveNamedBuilder(PrepaymentSegment::class);
    }

    /**
     * Приемка
     *
     * <code>
     * $supplies = $ms->query()
     *  ->entity()
     *  ->supply()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-priemka
     */
    public function supply(): SupplySegment
    {
        return $this->resolveNamedBuilder(SupplySegment::class);
    }

    /**
     * Приходный ордер
     *
     * <code>
     * $cashIns = $ms->query()
     *  ->entity()
     *  ->cashin()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prihodnyj-order
     */
    public function cashin(): CashInSegment
    {
        return $this->resolveNamedBuilder(CashInSegment::class);
    }

    /**
     * Расходный ордер
     *
     * <code>
     * $cashOuts = $ms->query()
     *  ->entity()
     *  ->cashout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-rashodnyj-order
     */
    public function cashout(): CashOutSegment
    {
        return $this->resolveNamedBuilder(CashOutSegment::class);
    }

    /**
     * Розничная продажа
     *
     * <code>
     * $retailDemands = $ms->query()
     *  ->entity()
     *  ->retaildemand()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-prodazha
     */
    public function retaildemand(): RetailDemandSegment
    {
        return $this->resolveNamedBuilder(RetailDemandSegment::class);
    }

    /**
     * Розничная смена
     *
     * <code>
     * $retailShifts = $ms->query()
     *  ->entity()
     *  ->retailshift()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-smena
     */
    public function retailshift(): RetailShiftSegment
    {
        return $this->resolveNamedBuilder(RetailShiftSegment::class);
    }

    /**
     * Розничный возврат
     *
     * <code>
     * $retailSalesReturns = $ms->query()
     *  ->entity()
     *  ->retailsalesreturn()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnyj-wozwrat
     */
    public function retailsalesreturn(): RetailSalesReturnSegment
    {
        return $this->resolveNamedBuilder(RetailSalesReturnSegment::class);
    }

    /**
     * Списание
     *
     * <code>
     * $losses = $ms->query()
     *  ->entity()
     *  ->loss()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-spisanie
     */
    public function loss(): LossSegment
    {
        return $this->resolveNamedBuilder(LossSegment::class);
    }

    /**
     * Счет покупателю
     *
     * <code>
     * $invoiceOuts = $ms->query()
     *  ->entity()
     *  ->invoiceout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-pokupatelu
     */
    public function invoiceout(): InvoiceOutSegment
    {
        return $this->resolveNamedBuilder(InvoiceOutSegment::class);
    }

    /**
     * Счет поставщика
     *
     * <code>
     * $invoiceIns = $ms->query()
     *  ->entity()
     *  ->invoicein()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-postawschika
     */
    public function invoicein(): InvoiceInSegment
    {
        return $this->resolveNamedBuilder(InvoiceInSegment::class);
    }

    /**
     * Счет-фактура выданный
     *
     * <code>
     * $factureOuts = $ms->query()
     *  ->entity()
     *  ->factureout()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-faktura-wydannyj
     */
    public function factureout(): FactureOutSegment
    {
        return $this->resolveNamedBuilder(FactureOutSegment::class);
    }

    /**
     * Счет-фактура полученный
     *
     * <code>
     * $factureIns = $ms->query()
     *  ->entity()
     *  ->facturein()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-schet-faktura-poluchennyj
     */
    public function facturein(): FactureInSegment
    {
        return $this->resolveNamedBuilder(FactureInSegment::class);
    }

    /**
     * Техоперация
     *
     * <code>
     * $processings = $ms->query()
     *  ->entity()
     *  ->processing()
     *  ->get();
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-tehoperaciq
     */
    public function processing(): ProcessingSegment
    {
        return $this->resolveNamedBuilder(ProcessingSegment::class);
    }
}
