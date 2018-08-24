<?php
namespace Sellastica\Integroid\Service;

class IntegroidUserService
{
	/** @var \Sellastica\Entity\EntityManager */
	protected $em;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->em = $em;
	}

	/**
	 * @param array $filterValues
	 * @param \Sellastica\Entity\Configuration $configuration
	 * @return \Sellastica\Integroid\Entity\IntegroidUserCollection|\Sellastica\Integroid\Entity\IntegroidUser[]
	 */
	public function findBy(
		array $filterValues,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Integroid\Entity\IntegroidUserCollection
	{
		return $this->em->getRepository(\Sellastica\Integroid\Entity\IntegroidUser::class)->findBy(
			$filterValues, $configuration
		);
	}

	/**
	 * @param string $id
	 * @return \Sellastica\Integroid\Entity\IntegroidUser|null
	 */
	public function find(string $id): ?\Sellastica\Integroid\Entity\IntegroidUser
	{
		return $this->em->getRepository(\Sellastica\Integroid\Entity\IntegroidUser::class)->find($id);
	}

	/**
	 * @param array $filterValues
	 * @param \Sellastica\Entity\Configuration $configuration
	 * @return \Sellastica\Integroid\Entity\IntegroidUser|null
	 */
	public function findOneBy(
		array $filterValues,
		\Sellastica\Entity\Configuration $configuration = null
	): ?\Sellastica\Integroid\Entity\IntegroidUser
	{
		return $this->em->getRepository(\Sellastica\Integroid\Entity\IntegroidUser::class)->findOneBy(
			$filterValues, $configuration
		);
	}

	/**
	 * @param string $email
	 * @param string $password
	 * @return null|\Sellastica\Integroid\Entity\IntegroidUser
	 */
	public function findOneByEmailAndPassword(
		string $email,
		string $password
	): ?\Sellastica\Integroid\Entity\IntegroidUser
	{
		//admin users check
		$users = $this->findBy(['email' => $email]);
		foreach ($users as $user) {
			if (\Nette\Security\Passwords::verify($password, $user->getPassword())) {
				return $user;
			}
		}

		return null;
	}
}