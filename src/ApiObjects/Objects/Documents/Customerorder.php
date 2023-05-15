<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Objects\Documents;

use Evgeek\Moysklad\ApiObjects\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\ApiObjects\Collections\CustomerorderCollection;
use Evgeek\Moysklad\ApiObjects\Collections\UnknownCollection;
use Evgeek\Moysklad\ApiObjects\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\ApiObjects\Objects\Entities\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Document;
use Evgeek\Moysklad\Dictionaries\Endpoint;

/**
 * Заказ покупателя
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/documents/#dokumenty-zakaz-pokupatelq
 *
 * @property string            $accountId
 * @property UnknownObject     $agent
 * @property ?UnknownObject    $agentAccount
 * @property bool              $applicable
 * @property ?UnknownObject[]  $attributes
 * @property ?string           $code
 * @property ?UnknownObject    $contract
 * @property string            $created
 * @property ?string           $deleted
 * @property ?string           $deliveryPlannedMoment
 * @property ?string           $description
 * @property string            $externalCode
 * @property UnknownCollection $files
 * @property UnknownObject     $group
 * @property string            $id
 * @property float             $invoicedSum
 * @property ?MetaObject       $meta
 * @property string            $moment
 * @property string            $name
 * @property UnknownObject     $organization
 * @property ?UnknownObject    $organizationAccount
 * @property ?Employee         $owner
 * @property float             $payedSum
 * @property UnknownCollection $positions
 * @property bool              $printed
 * @property ?UnknownObject    $project
 * @property bool              $published
 * @property UnknownObject     $rate
 * @property bool              $shared
 * @property ?float            $shippedSum
 * @property ?UnknownObject    $state
 * @property ?UnknownObject    $store
 * @property ?int              $sum
 * @property ?string           $syncId
 * @property string            $updated
 * @property string            $vatEnabled
 * @property ?bool             $vatIncluded
 * @property ?float            $vatSum
 * @property ?float            $waitSum
 * @property ?UnknownObject[]  $purchaseOrders
 * @property ?UnknownObject[]  $demands
 * @property ?UnknownObject[]  $payments
 * @property ?UnknownObject[]  $invoicesOut
 * @property ?UnknownObject[]  $moves
 * @property ?UnknownObject[]  $prepayments
 *
 * @implements AbstractConcreteObject<CustomerorderCollection>
 */
class Customerorder extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Document::CUSTOMERORDER,
    ];
    public const TYPE = Document::CUSTOMERORDER;
}
