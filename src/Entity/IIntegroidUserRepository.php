<?php
namespace Sellastica\Integroid\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;
use Sellastica\Integroid\Entity\IntegroidUser;
use Sellastica\Integroid\Entity\IntegroidUserCollection;

/**
 * @method IntegroidUser find(int $id)
 * @method IntegroidUser findOneBy(array $filterValues)
 * @method IntegroidUser findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method IntegroidUser[]|IntegroidUserCollection findAll(Configuration $configuration = null)
 * @method IntegroidUser[]|IntegroidUserCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method IntegroidUser[]|IntegroidUserCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method IntegroidUser[]|IntegroidUserCollection findPublishable(int $id)
 * @method IntegroidUser[]|IntegroidUserCollection findAllPublishable(Configuration $configuration = null)
 * @method IntegroidUser[]|IntegroidUserCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see IntegroidUser
 */
interface IIntegroidUserRepository extends IRepository
{
}