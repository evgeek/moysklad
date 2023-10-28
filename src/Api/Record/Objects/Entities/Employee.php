<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\EmployeeImageObject;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Сотрудник
 *
 * @property string               $accountId    ID учетной записи
 * @property bool                 $archived     Добавлен ли Сотрудник в архив
 * @property ?UnknownObject[]     $attributes   Дополнительные поля Сотрудника
 * @property ?UnknownObject[]     $cashiers     Массив кассиров
 * @property ?string              $code         Код Сотрудника
 * @property string               $created      Момент создания Сотрудника
 * @property ?string              $description  Комментарий к Сотруднику
 * @property ?string              $email        Электронная почта сотрудника
 * @property string               $externalCode Внешний код Сотрудника
 * @property ?string              $firstName    Имя
 * @property ?string              $fullName     Имя Отчество Фамилия
 * @property UnknownObject        $group        Отдел сотрудника
 * @property string               $id           ID Сотрудника
 * @property ?EmployeeImageObject $image        Фотография сотрудника
 * @property ?string              $inn          ИНН сотрудника (в формате ИНН физического лица)
 * @property string               $lastName     Фамилия
 * @property ?MetaObject          $meta         Метаданные Сотрудника
 * @property ?string              $middleName   Отчество
 * @property string               $name         Наименование Сотрудника
 * @property Employee             $owner        Владелец (Сотрудник)
 * @property ?string              $phone        Телефон сотрудника
 * @property ?string              $position     Должность сотрудника
 * @property bool                 $shared       Общий доступ
 * @property ?string              $shortFio     Краткое ФИО
 * @property ?string              $uid          Логин Сотрудника
 * @property string               $updated      Момент последнего обновления Сотрудника
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik
 *
 * @implements AbstractConcreteObject<EmployeeCollection>
 */
class Employee extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EMPLOYEE,
    ];
    public const TYPE = Type::EMPLOYEE;
}
