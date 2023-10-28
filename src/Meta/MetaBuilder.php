<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Meta;

use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Formatters\JsonFormatterInterface;
use Evgeek\Moysklad\Tools\Meta;

class MetaBuilder
{
    public function __construct(protected readonly JsonFormatterInterface $formatter)
    {
    }

    /**
     * Метаданные неизвестной сущности
     *
     * <code>
     * $productMeta = $ms->meta()->create(['entity', 'product'], 'product');
     * </code>
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function create(array $path, string $type)
    {
        return Meta::create($path, $type, $this->formatter);
    }

    /**
     * Метаданные Бонусной операции
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-operaciq
     */
    public function bonustransaction(string $guid)
    {
        return Meta::bonustransaction($guid, $this->formatter);
    }

    /**
     * Метаданные Бонусной программы
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-bonusnaq-programma
     */
    public function bonusprogram(string $guid)
    {
        return Meta::bonusprogram($guid, $this->formatter);
    }

    /**
     * Метаданные Валюты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-valuta
     */
    public function currency(string $guid)
    {
        return Meta::currency($guid, $this->formatter);
    }

    /**
     * Метаданные Вебхука
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
     */
    public function webhook(string $guid)
    {
        return Meta::webhook($guid, $this->formatter);
    }

    /**
     * Метаданные Вебхука на изменение остатков
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
     */
    public function webhookstock(string $guid)
    {
        return Meta::webhookstock($guid, $this->formatter);
    }

    /**
     * Метаданные Группы товаров
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-gruppa-towarow
     */
    public function productfolder(string $guid)
    {
        return Meta::productfolder($guid, $this->formatter);
    }

    /**
     * Метаданные Договора
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-dogowor
     */
    public function contract(string $guid)
    {
        return Meta::contract($guid, $this->formatter);
    }

    /**
     * Метаданные Единицы измерения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-edinica-izmereniq
     */
    public function uom(string $guid)
    {
        return Meta::uom($guid, $this->formatter);
    }

    /**
     * Метаданные Задачи
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-zadacha
     */
    public function task(string $guid)
    {
        return Meta::task($guid, $this->formatter);
    }

    /**
     * Метаданные Изображения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-izobrazhenie
     */
    public function image(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::image($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Канала продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kanal-prodazh
     */
    public function saleschannel(string $guid)
    {
        return Meta::saleschannel($guid, $this->formatter);
    }

    /**
     * Метаданные Кассира
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kassir
     */
    public function cashier(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::cashier($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Комплекта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
     */
    public function bundle(string $guid)
    {
        return Meta::bundle($guid, $this->formatter);
    }

    /**
     * Метаданные Контрагента
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kontragent
     */
    public function counterparty(string $guid)
    {
        return Meta::counterparty($guid, $this->formatter);
    }

    /**
     * Метаданные Модификации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-modifikaciq
     */
    public function variant(string $guid)
    {
        return Meta::variant($guid, $this->formatter);
    }

    /**
     * Метаданные Настроек компании
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-kompanii
     */
    public function companysettings()
    {
        return Meta::companysettings($this->formatter);
    }

    /**
     * Метаданные Настроек пользователя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-nastrojki-pol-zowatelq
     */
    public function usersettings()
    {
        return Meta::usersettings($this->formatter);
    }

    /**
     * Метаданные Отдела
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-otdel
     */
    public function group(string $guid)
    {
        return Meta::group($guid, $this->formatter);
    }

    /**
     * Метаданные Пользовательской роли
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skie-roli
     */
    public function role(string $guid)
    {
        return Meta::role($guid, $this->formatter);
    }

    /**
     * Метаданные Пользовательского справочника
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-pol-zowatel-skij-sprawochnik
     */
    public function customentity(string $guid)
    {
        return Meta::customentity($guid, $this->formatter);
    }

    /**
     * Метаданные Проекта
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-proekt
     */
    public function project(string $guid)
    {
        return Meta::project($guid, $this->formatter);
    }

    /**
     * Метаданные Региона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-region
     */
    public function region(string $guid)
    {
        return Meta::region($guid, $this->formatter);
    }

    /**
     * Метаданные Серии
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
     */
    public function consignment(string $guid)
    {
        return Meta::consignment($guid, $this->formatter);
    }

    /**
     * Метаданные Накопительной скидки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function accumulationdiscount(string $guid)
    {
        return Meta::accumulationdiscount($guid, $this->formatter);
    }

    /**
     * Метаданные Персональной скидки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function personaldiscount(string $guid)
    {
        return Meta::personaldiscount($guid, $this->formatter);
    }

    /**
     * Метаданные Специальной цены
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-skidki
     */
    public function specialpricediscount(string $guid)
    {
        return Meta::specialpricediscount($guid, $this->formatter);
    }

    /**
     * Метаданные Склада
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sklad
     */
    public function store(string $guid)
    {
        return Meta::store($guid, $this->formatter);
    }

    /**
     * Метаданные Сотрудника
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
     */
    public function employee(string $guid)
    {
        return Meta::employee($guid, $this->formatter);
    }

    /**
     * Метаданные Сохраненного фильтра
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sohranennye-fil-try
     */
    public function namedfilter(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::namedfilter($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Ставки НДС
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stawka-nds
     */
    public function taxrate(string $guid)
    {
        return Meta::taxrate($guid, $this->formatter);
    }

    /**
     * Метаданные Статуса документов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-statusy-dokumentow
     */
    public function state(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::state($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Статьи расходов
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-stat-q-rashodow
     */
    public function expenseitem(string $guid)
    {
        return Meta::expenseitem($guid, $this->formatter);
    }

    /**
     * Метаданные Страны
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-strana
     */
    public function country(string $guid)
    {
        return Meta::country($guid, $this->formatter);
    }

    /**
     * Метаданные Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta
     */
    public function processingplan(string $guid)
    {
        return Meta::processingplan($guid, $this->formatter);
    }

    /**
     * Метаданные Этапа Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-jetapy-tehkarty
     */
    public function processingplanstages(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::processingplanstages($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Материала Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-material-tehkarty
     */
    public function processingplanmaterial(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::processingplanmaterial($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Продукта Техкарты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehkarta-produkty-tehkarty
     */
    public function processingplanresult(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::processingplanresult($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Техпроцесса
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tehprocess
     */
    public function processingprocess(string $guid)
    {
        return Meta::processingprocess($guid, $this->formatter);
    }

    /**
     * Метаданные Типа цены
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tipy-cen
     */
    public function pricetype(string $guid)
    {
        return Meta::pricetype($guid, $this->formatter);
    }

    /**
     * Метаданные Товара
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
     */
    public function product(string $guid)
    {
        return Meta::product($guid, $this->formatter);
    }

    /**
     * Метаданные Точки продаж
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-tochka-prodazh
     */
    public function retailstore(string $guid)
    {
        return Meta::retailstore($guid, $this->formatter);
    }

    /**
     * Метаданные Услуги
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
     */
    public function service(string $guid)
    {
        return Meta::service($guid, $this->formatter);
    }

    /**
     * Метаданные Файла
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-fajly
     */
    public function files(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::files($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Характеристики модификации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-harakteristiki-modifikacij
     */
    public function attributemetadata(string $guid)
    {
        return Meta::attributemetadata($guid, $this->formatter);
    }

    /**
     * Метаданные Стандартного шаблона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-standartnyh-shablonow
     */
    public function embeddedtemplate(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::embeddedtemplate($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Пользовательского шаблона
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy-spisok-pol-zowatel-skih-shablonow
     */
    public function customtemplate(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::customtemplate($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Юрлица
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico
     */
    public function organization(string $guid)
    {
        return Meta::organization($guid, $this->formatter);
    }

    /**
     * Метаданные Счёта юрлица
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico-scheta-urlica
     */
    public function account(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::account($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Этапа производства
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jetap-proizwodstwa
     */
    public function processingstage(string $guid)
    {
        return Meta::processingstage($guid, $this->formatter);
    }

    /**
     * Метаданные Внесения денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnesenie-deneg
     */
    public function retaildrawercashin(string $guid)
    {
        return Meta::retaildrawercashin($guid, $this->formatter);
    }

    /**
     * Метаданные Внутреннего заказа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vnutrennij-zakaz
     */
    public function internalorder(string $guid)
    {
        return Meta::internalorder($guid, $this->formatter);
    }

    /**
     * Метаданные Возвратов покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-pokupatelq
     */
    public function salesreturn(string $guid)
    {
        return Meta::salesreturn($guid, $this->formatter);
    }

    /**
     * Метаданные Возвратов поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-postawschiku
     */
    public function purchasereturn(string $guid)
    {
        return Meta::purchasereturn($guid, $this->formatter);
    }

    /**
     * Метаданные Возвратов предоплаты
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vozwrat-predoplaty
     */
    public function prepaymentreturn(string $guid)
    {
        return Meta::prepaymentreturn($guid, $this->formatter);
    }

    /**
     * Метаданные Входящего платежа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vhodqschij-platezh
     */
    public function paymentin(string $guid)
    {
        return Meta::paymentin($guid, $this->formatter);
    }

    /**
     * Метаданные Выданного отчета комиссионера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vydannyj-otchet-komissionera
     */
    public function commissionreportout(string $guid)
    {
        return Meta::commissionreportout($guid, $this->formatter);
    }

    /**
     * Метаданные Выплаты денег
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-vyplata-deneg
     */
    public function retaildrawercashout(string $guid)
    {
        return Meta::retaildrawercashout($guid, $this->formatter);
    }

    /**
     * Метаданные Заказа на производство
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-na-proizwodstwo
     */
    public function processingorder(string $guid)
    {
        return Meta::processingorder($guid, $this->formatter);
    }

    /**
     * Метаданные Заказа покупателя
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
     */
    public function customerorder(string $guid)
    {
        return Meta::customerorder($guid, $this->formatter);
    }

    /**
     * Метаданные Заказа поставщику
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-postawschiku
     */
    public function purchaseorder(string $guid)
    {
        return Meta::purchaseorder($guid, $this->formatter);
    }

    /**
     * Метаданные Инвентаризации
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-inwentarizaciq
     */
    public function inventory(string $guid)
    {
        return Meta::inventory($guid, $this->formatter);
    }

    /**
     * Метаданные Исходящего платежа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-ishodqschij-platezh
     */
    public function paymentout(string $guid)
    {
        return Meta::paymentout($guid, $this->formatter);
    }

    /**
     * Метаданные Корректировки баланса контрагента
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-korrektirowka-balansa-kontragenta
     */
    public function counterpartyadjustment(string $guid)
    {
        return Meta::counterpartyadjustment($guid, $this->formatter);
    }

    /**
     * Метаданные Оприходования
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-oprihodowanie
     */
    public function enter(string $guid)
    {
        return Meta::enter($guid, $this->formatter);
    }

    /**
     * Метаданные Отгрузки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-otgruzka
     */
    public function demand(string $guid)
    {
        return Meta::demand($guid, $this->formatter);
    }

    /**
     * Метаданные Перемещения
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-peremeschenie
     */
    public function move(string $guid)
    {
        return Meta::move($guid, $this->formatter);
    }

    /**
     * Метаданные Позиции возврата на склад комиссионера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera-pozicii-wozwrata-na-sklad-komissionera
     */
    public function returntocommissionerposition(ObjectInterface|array|string $parent, string $guid)
    {
        return Meta::returntocommissionerposition($parent, $guid, $this->formatter);
    }

    /**
     * Метаданные Полученного отчета комиссионера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-poluchennyj-otchet-komissionera
     */
    public function commissionreportin(string $guid)
    {
        return Meta::commissionreportin($guid, $this->formatter);
    }

    /**
     * Метаданные Прайс-листа
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prajs-list
     */
    public function pricelist(string $guid)
    {
        return Meta::pricelist($guid, $this->formatter);
    }

    /**
     * Метаданные Предоплат
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-predoplata
     */
    public function prepayment(string $guid)
    {
        return Meta::prepayment($guid, $this->formatter);
    }

    /**
     * Метаданные Приемки
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-priemka
     */
    public function supply(string $guid)
    {
        return Meta::supply($guid, $this->formatter);
    }

    /**
     * Метаданные Приходного ордера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-prihodnyj-order
     */
    public function cashin(string $guid)
    {
        return Meta::cashin($guid, $this->formatter);
    }

    /**
     * Метаданные Расходного ордера
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-rashodnyj-order
     */
    public function cashout(string $guid)
    {
        return Meta::cashout($guid, $this->formatter);
    }

    /**
     * Метаданные Розничной продажи
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-prodazha
     */
    public function retaildemand(string $guid)
    {
        return Meta::retaildemand($guid, $this->formatter);
    }

    /**
     * Метаданные Розничной смены
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnaq-smena
     */
    public function retailshift(string $guid)
    {
        return Meta::retailshift($guid, $this->formatter);
    }

    /**
     * Метаданные Розничного возврата
     *
     * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-roznichnyj-wozwrat
     */
    public function retailsalesreturn(string $guid)
    {
        return Meta::retailsalesreturn($guid, $this->formatter);
    }
}
