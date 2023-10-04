<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Documents;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerOrderCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Заказ покупателя
 *
 * @property string            $accountId             ID учетной записи
 * @property UnknownObject     $agent                 Метаданные контрагента
 * @property ?UnknownObject    $agentAccount          Метаданные счета контрагента
 * @property bool              $applicable            Отметка о проведении
 * @property ?UnknownObject[]  $attributes            Коллекция метаданных доп. полей
 * @property ?string           $code                  Код Заказа покупателя
 * @property ?UnknownObject    $contract              Метаданные договора
 * @property string            $created               Дата создания
 * @property ?string           $deleted               Момент последнего удаления Заказа покупателя
 * @property ?string           $deliveryPlannedMoment Планируемая дата отгрузки
 * @property ?string           $description           Комментарий Заказа покупателя
 * @property string            $externalCode          Внешний код Заказа покупателя
 * @property UnknownCollection $files                 Метаданные массива Файлов
 * @property UnknownObject     $group                 Отдел сотрудника
 * @property string            $id                    ID Заказа покупателя
 * @property float             $invoicedSum           Сумма счетов покупателю
 * @property ?MetaObject       $meta                  Метаданные Заказа покупателя
 * @property string            $moment                Дата документа
 * @property string            $name                  Наименование Заказа покупателя
 * @property UnknownObject     $organization          Метаданные юрлица
 * @property ?UnknownObject    $organizationAccount   Метаданные счета юрлица
 * @property ?Employee         $owner                 Владелец (Сотрудник)
 * @property float             $payedSum              Сумма входящих платежей по Заказу
 * @property UnknownCollection $positions             Метаданные позиций Заказа покупателя
 * @property bool              $printed               Напечатан ли документ
 * @property ?UnknownObject    $project               Метаданные проекта
 * @property bool              $published             Опубликован ли документ
 * @property UnknownObject     $rate                  Валюта
 * @property float             $reservedSum           Сумма товаров в резерве
 * @property ?UnknownObject    $salesChannel          Метаданные канала продаж
 * @property ?string           $shipmentAddress       Адрес доставки Заказа покупателя
 * @property ?string           $shipmentAddressFull   Адрес доставки Заказа покупателя с детализацией по отдельным полям
 * @property float             $shippedSum            Сумма отгруженного
 * @property ?UnknownObject    $state                 Метаданные статуса заказа
 * @property ?UnknownObject    $store                 Метаданные склада
 * @property int               $sum                   Сумма Заказа в установленной валюте
 * @property ?string           $syncId                ID синхронизации. После заполнения недоступен для изменения
 * @property ?string           $taxSystem             Код системы налогообложения
 * @property string            $updated               Момент последнего обновления Заказа покупателя
 * @property bool              $vatEnabled            Учитывается ли НДС
 * @property ?bool             $vatIncluded           Включен ли НДС в цену
 * @property float             $vatSum                Сумма НДС
 * @property ?float            $waitSum
 * @property ?UnknownObject[]  $purchaseOrders
 * @property ?UnknownObject[]  $demands
 * @property ?UnknownObject[]  $payments
 * @property ?UnknownObject[]  $invoicesOut
 * @property ?UnknownObject[]  $moves
 * @property ?UnknownObject[]  $prepayments
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
 *
 * @implements AbstractConcreteObject<CustomerOrderCollection>
 */
class CustomerOrder extends AbstractDocument
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CUSTOMERORDER,
    ];
    public const TYPE = Type::CUSTOMERORDER;
}
