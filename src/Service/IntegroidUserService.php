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
	 * @return \Suppliers\Entity\Product\Entity\ProductCollection
	 */
	public function findBy(
		array $filterValues,
		\Sellastica\Entity\Configuration $configuration = null
	): \Suppliers\Entity\Product\Entity\ProductCollection
	{
		return $this->em->getRepository(\Sellastica\Integroid\Entity\IntegroidUser::class)->findBy(
			$filterValues, $configuration
		);
	}

	/**
	 * @param string $id
	 * @return \Suppliers\Entity\Product\Entity\Product|null
	 */
	public function find(string $id): ?\Suppliers\Entity\Product\Entity\Product
	{
		return $this->em->getRepository(\Suppliers\Entity\Product\Entity\Product::class)->find($id);
	}

	/**
	 * @param array $filterValues
	 * @param \Sellastica\Entity\Configuration $configuration
	 * @return \Suppliers\Entity\Product\Entity\Product|null
	 */
	public function findOneBy(
		array $filterValues,
		\Sellastica\Entity\Configuration $configuration = null
	): ?\Suppliers\Entity\Product\Entity\Product
	{
		return $this->em->getRepository(\Suppliers\Entity\Product\Entity\Product::class)->findOneBy(
			$filterValues, $configuration
		);
	}
}