<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Overhead;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Price;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\PriceWithType;
use Evgeek\Moysklad\Api\Record\Collections\Entities\BundleCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Комплект
 *
 * @property string             $accountId           ID учетной записи
 * @property bool               $archived            Добавлен ли Комплект в архив
 * @property ?string            $article             Артикулв
 * @property ?UnknownObject[]   $attributes          Коллекция доп. полей
 * @property ?Barcode[]         $barcodes            Штрихкоды Комплекта
 * @property ?string            $code                Код Комплекта
 * @property ?UnknownCollection $components          Массив компонентов Комплекта
 * @property ?UnknownObject     $country             Метаданные Страны
 * @property ?string            $description         Описание Комплекта
 * @property bool               $discountProhibited  Признак запрета скидок
 * @property ?int               $effectiveVat        Реальный НДС %
 * @property ?bool              $effectiveVatEnabled Дополнительный признак для определения разграничения реального НДС = 0 или "без НДС"
 * @property string             $externalCode        Внешний код Комплекта
 * @property ?UnknownCollection $files               Метаданные массива Файлов (Максимальное количество файлов - 100)
 * @property UnknownObject      $group               Метаданные отдела сотрудника
 * @property string             $id                  ID Комплекта
 * @property ?UnknownCollection $images              Массив метаданных Изображений (Максимальное количество изображений - 10)
 * @property ?MetaObject        $meta                Метаданные Комплекта
 * @property ?Price             $minPrice            Минимальная цена
 * @property string             $name                Наименование Комплекта
 * @property ?Overhead          $overhead            Дополнительные расходы
 * @property ?Employee          $owner               Метаданные владельца (Сотрудника)
 * @property ?bool              $partialDisposal     Управление состоянием частичного выбытия маркированного товара. «true» - возможность включена.
 * @property string             $pathName            Наименование группы, в которую входит Комплект
 * @property ?string            $paymentItemType     Признак предмета расчета
 * @property ?string            $ppeType             Код вида номенклатурной классификации медицинских средств индивидуальной защиты (EAN-13)
 * @property ?UnknownObject     $productFolder       Метаданные группы Комплекта
 * @property ?PriceWithType[]   $salePrices          Цены продажи
 * @property bool               $shared              Общий доступ
 * @property ?string            $syncId              ID синхронизации
 * @property ?string            $taxSystem           Код системы налогообложения
 * @property ?string            $tnved               Код ТН ВЭД
 * @property ?string            $trackingType        Тип маркируемой продукции
 * @property ?UnknownObject     $uom                 Единицы измерения
 * @property string             $updated             Момент последнего обновления сущности
 * @property bool               $useParentVat        Используется ли ставка НДС родительской группы
 * @property ?int               $vat                 НДС %
 * @property ?bool              $vatEnabled          Включен ли НДС для товара. С помощью этого флага для товара можно выставлять НДС = 0 или НДС = "без НДС"
 * @property ?int               $volume              Объем
 * @property ?int               $weight              Вес
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt
 *
 * @implements AbstractConcreteObject<BundleCollection>
 */
class Bundle extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::BUNDLE,
    ];
    public const TYPE = Type::BUNDLE;
}
