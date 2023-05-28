<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Alcoholic;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Pack;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Price;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\PriceWithType;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Товар
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar
 *
 * @implements AbstractConcreteObject<ProductCollection>
 *
 * @property string             $id
 * @property string             $accountId
 * @property ?Employee          $owner
 * @property string             $name
 * @property ?MetaObject        $meta
 * @property bool               $shared
 * @property UnknownObject      $group
 * @property ?UnknownCollection $images
 * @property string             $updated
 * @property ?string            $code
 * @property string             $externalCode
 * @property bool               $archived
 * @property bool               $useParentVat
 * @property string             $pathName
 * @property ?Price             $minPrice
 * @property ?PriceWithType[]   $salePrices
 * @property ?Price             $buyPrice
 * @property ?Barcode[]         $barcodes
 * @property ?string            $paymentItemType
 * @property bool               $discountProhibited
 * @property ?int               $weight
 * @property ?int               $volume
 * @property int                $variantsCount
 * @property ?bool              $isSerialTrackable
 * @property ?string            $trackingType
 * @property ?UnknownCollection $files
 * @property ?Alcoholic         $alcoholic
 * @property ?string            $article
 * @property ?string            $description
 * @property ?UnknownObject     $country
 * @property ?int               $effectiveVat
 * @property ?bool              $effectiveVatEnabled
 * @property ?bool              $vatEnabled
 * @property ?int               $minimumBalance
 * @property ?Pack[]            $packs
 * @property ?bool              $partialDisposal
 * @property ?string            $ppeType
 * @property ?UnknownObject     $productFolder
 * @property ?UnknownObject     $supplier
 * @property ?string            $syncId
 * @property ?string            $taxSystem
 * @property ?string[]          $things
 * @property ?string            $tnved
 * @property ?UnknownObject     $uom
 * @property ?int               $vat
 * @property ?UnknownObject[]   $attributes
 */
class Product extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::PRODUCT,
    ];
    public const TYPE = Entity::PRODUCT;
}
