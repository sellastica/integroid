<?php
namespace Sellastica\Integroid\Mapping;

/**
 * @see \Sellastica\Integroid\Entity\IntegroidUser
 */
class IntegroidUserDibiMapper extends \Sellastica\Entity\Mapping\DibiMapper
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDibiMapper;


	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = false): string
	{
		return sprintf(
			'%s.admin_user',
			 $this->environment->isNapojSe() ? 'klient_napojse_cz' : 'myintegroid_com'
		);
	}

	/**
	 * @param string $hashId
	 * @return int|false
	 */
	public function findOneByHashId($hashId)
	{
		return $this->getResourceWithIds()
			->where('SHA1(CONCAT(email, id)) = %s', $hashId)
			->fetchSingle();
	}
}