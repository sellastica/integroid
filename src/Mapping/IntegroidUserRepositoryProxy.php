<?php
namespace Sellastica\Integroid\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Integroid\Entity\IIntegroidUserRepository;
use Sellastica\Integroid\Entity\IntegroidUser;

/**
 * @method \Sellastica\Integroid\Mapping\IntegroidUserRepository getRepository()
 * @see IntegroidUser
 */
class IntegroidUserRepositoryProxy extends RepositoryProxy implements IIntegroidUserRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepositoryProxy;
}