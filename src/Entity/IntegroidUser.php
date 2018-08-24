<?php
namespace Sellastica\Integroid\Entity;

/**
 * @generate-builder
 * @see IntegroidUserBuilder
 */
class IntegroidUser extends \Sellastica\AdminUI\User\Entity\AdminUser
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/**
	 * @param \Sellastica\Integroid\Entity\IntegroidUserBuilder $builder
	 */
	public function __construct(\Sellastica\Integroid\Entity\IntegroidUserBuilder $builder)
	{
		$this->hydrate($builder);
		$this->invalidLogin = $this->invalidLogin ?? new \Sellastica\Identity\Model\InvalidLogin();
	}
}