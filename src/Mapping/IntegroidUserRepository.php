<?php
namespace Sellastica\Integroid\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Integroid\Entity\IntegroidUser;
use Sellastica\Integroid\Entity\IIntegroidUserRepository;
use Sellastica\Integroid\Mapping\IntegroidUserDao;

/**
 * @property IntegroidUserDao $dao
 * @see \Sellastica\Integroid\Entity\IntegroidUser
 */
class IntegroidUserRepository extends Repository implements IIntegroidUserRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepository;

	/**
	 * @param string $hashId
	 * @return \Sellastica\AdminUI\User\Entity\AdminUser|\Sellastica\Entity\Entity\IEntity
	 */
	public function findOneByHashId($hashId)
	{
		return $this->initialize($this->dao->findOneByHashId($hashId));
	}
}