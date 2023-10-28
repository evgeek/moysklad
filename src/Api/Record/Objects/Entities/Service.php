<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Price;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\PriceWithType;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ServiceCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Товар
 *
 * @property string             $accountId           ID учетной записи
 * @property bool               $archived            Добавлен ли Товар в архив
 * @property ?UnknownObject[]   $attributes          Коллекция доп. полей
 * @property ?Barcode[]         $barcodes            Штрихкоды Комплекта
 * @property ?Price             $buyPrice            Закупочная цена
 * @property ?string            $code                Код Товара
 * @property ?string            $description         Описание Товара
 * @property bool               $discountProhibited  Признак запрета скидок
 * @property ?int               $effectiveVat        Реальный НДС %
 * @property ?bool              $effectiveVatEnabled Дополнительный признак для определения разграничения реального НДС = 0 или "без НДС"
 * @property string             $externalCode        Внешний код Товара
 * @property ?UnknownCollection $files               Метаданные массива Файлов (Максимальное количество файлов - 100)
 * @property UnknownObject      $group               Метаданные отдела сотрудника
 * @property string             $id                  ID Товара
 * @property ?MetaObject        $meta                Метаданные Товара
 * @property ?Price             $minPrice            Минимальная цена
 * @property string             $name                Наименование Товара
 * @property ?Employee          $owner               Метаданные владельца (Сотрудника)
 * @property string             $pathName            Наименование группы, в которую входит Товар
 * @property ?string            $paymentItemType     Признак предмета расчета
 * @property ?UnknownObject     $productFolder       Метаданные группы Товара
 * @property ?PriceWithType[]   $salePrices          Цены продажи
 * @property bool               $shared              Общий доступ
 * @property ?string            $syncId              ID синхронизации
 * @property ?string            $taxSystem           Код системы налогообложения
 * @property ?UnknownObject     $uom                 Единицы измерения
 * @property string             $updated             Момент последнего обновления сущности
 * @property bool               $useParentVat        Используется ли ставка НДС родительской группы
 * @property ?int               $vat                 НДС %
 * @property ?bool              $vatEnabled          Включен ли НДС для товара. С помощью этого флага для товара можно выставлять НДС = 0 или НДС = "без НДС"
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-usluga
 *
 * @implements AbstractConcreteObject<ServiceCollection>
 */
class Service extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::SERVICE,
    ];
    public const TYPE = Type::SERVICE;
}
