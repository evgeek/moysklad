<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Image;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Endpoint;
use Evgeek\Moysklad\Dictionaries\Entity;

/**
 * Сотрудник
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
 *
 * @implements AbstractConcreteObject<EmployeeCollection>
 *
 * @property string           $accountId
 * @property bool             $archived
 * @property ?UnknownObject[] $attributes
 * @property ?UnknownObject[] $cashiers
 * @property ?string          $code
 * @property string           $created
 * @property ?string          $description
 * @property ?string          $email
 * @property string           $externalCode
 * @property ?string          $firstName
 * @property ?string          $fullName
 * @property UnknownObject    $group
 * @property string           $id
 * @property ?Image           $image
 * @property ?string          $inn
 * @property string           $lastName
 * @property ?MetaObject      $meta
 * @property ?string          $middleName
 * @property string           $name
 * @property Employee         $owner
 * @property ?string          $phone
 * @property ?string          $position
 * @property bool             $shared
 * @property ?string          $shortFio
 * @property ?string          $uid
 * @property string           $updated
 */
class Employee extends AbstractConcreteObject
{
    public const PATH = [
        Endpoint::ENTITY,
        Entity::EMPLOYEE,
    ];
    public const TYPE = Entity::EMPLOYEE;
}
