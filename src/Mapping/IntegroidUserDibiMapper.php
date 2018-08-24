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
		return 'myintegroid_com.admin_user';
	}
}