<?php
namespace Sellastica\Integroid\Model;

class MasterProjectFactory
{
	/** @var int */
	private $masterProjectId;
	/** @var \Sellastica\Project\Service\ProjectService */
	private $projectService;


	/**
	 * @param int $masterProjectId
	 * @param \Sellastica\Project\Service\ProjectService $projectService
	 */
	public function __construct(
		int $masterProjectId,
		\Sellastica\Project\Service\ProjectService $projectService
	)
	{
		$this->masterProjectId = $masterProjectId;
		$this->projectService = $projectService;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function create(): \Sellastica\Project\Entity\Project
	{
		return $this->projectService->find($this->masterProjectId);
	}
}