<?php
namespace Sellastica\Integroid\Entity;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Integroid\Entity\IntegroidUser;

/**
 * @property IntegroidUser[] $items
 * @method IntegroidUserCollection add($entity)
 * @method IntegroidUserCollection remove($key)
 * @method IntegroidUser|mixed getEntity(int $entityId, $default = null)
 * @method IntegroidUser|mixed getBy(string $property, $value, $default = null)
 */
class IntegroidUserCollection extends EntityCollection
{
}