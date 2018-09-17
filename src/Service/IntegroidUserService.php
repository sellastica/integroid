<?php
namespace Sellastica\Integroid\Service;

class IntegroidUserService
{
	/** @var \Sellastica\Entity\EntityManager */
	protected $em;
	/** @var \Sellastica\SmtpMailer\SmtpMailer */
	private $mailer;
	/** @var \Sellastica\Project\Service\ProjectService */
	private $projectService;
	/** @var \Nette\Bridges\ApplicationLatte\ILatteFactory */
	private $latteFactory;
	/** @var \Nette\Localization\ITranslator */
	private $translator;
	/** @var string */
	private $applicationEmail;
	/** @var \Sellastica\Integroid\Model\MasterProjectFactory */
	private $masterProjectFactory;
	/** @var \Sellastica\Core\Model\Environment */
	private $environment;


	/**
	 * @param string $applicationEmail
	 * @param \Sellastica\Integroid\Model\MasterProjectFactory $masterProjectFactory
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\SmtpMailer\SmtpMailer $mailer
	 * @param \Sellastica\Project\Service\ProjectService $projectService
	 * @param \Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory
	 * @param \Nette\Localization\ITranslator $translator
	 * @param \Sellastica\Core\Model\Environment $environment
	 */
	public function __construct(
		string $applicationEmail,
		\Sellastica\Integroid\Model\MasterProjectFactory $masterProjectFactory,
		\Sellastica\Entity\EntityManager $em,
		\Sellastica\SmtpMailer\SmtpMailer $mailer,
		\Sellastica\Project\Service\ProjectService $projectService,
		\Nette\Bridges\ApplicationLatte\ILatteFactory $latteFactory,
		\Nette\Localization\ITranslator $translator,
		\Sellastica\Core\Model\Environment $environment
	)
	{
		$this->em = $em;
		$this->mailer = $mailer;
		$this->projectService = $projectService;
		$this->latteFactory = $latteFactory;
		$this->translator = $translator;
		$this->applicationEmail = $applicationEmail;
		$this->masterProjectFactory = $masterProjectFactory;
		$this->environment = $environment;
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
	 * @param string $hash
	 * @return null|\Sellastica\Integroid\Entity\IntegroidUser
	 */
	public function findOneByHashId(string $hash): ?\Sellastica\Integroid\Entity\IntegroidUser
	{
		return $this->em->getRepository(\Sellastica\Integroid\Entity\IntegroidUser::class)->findOneByHashId($hash);
	}

	/**
	 * @param string $email
	 * @return null|\Sellastica\Integroid\Entity\IntegroidUser
	 */
	public function findOneByEmail(string $email): ?\Sellastica\Integroid\Entity\IntegroidUser
	{
		return $this->findOneBy(['email' => $email]);
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

	/**
	 * @param int $projectId
	 * @param string $firstName
	 * @param string $lastName
	 * @param string|\Sellastica\Identity\Model\Email $email
	 * @param null $password
	 * @return \Sellastica\Integroid\Entity\IntegroidUser
	 */
	public function create(
		int $projectId,
		string $firstName,
		string $lastName,
		$email,
		$password = null
	): \Sellastica\Integroid\Entity\IntegroidUser
	{
		if (!$email instanceof \Sellastica\Identity\Model\Email) {
			$email = new \Sellastica\Identity\Model\Email($email);
		}

		if (!$password instanceof \Sellastica\Identity\Model\Password) {
			$password = new \Sellastica\Identity\Model\Password($password ?? uniqid());
		}

		$user = \Sellastica\Integroid\Entity\IntegroidUserBuilder::create(
			new \Sellastica\AdminUI\User\Model\AdminUserRole(\Sellastica\AdminUI\User\Model\AdminUserRole::ADMINISTRATOR),
			new \Sellastica\Identity\Model\Contact($firstName, $lastName, $email)
		)->projectId($projectId)
			->password($password)
			->build();
		$user->hashPassword();
		$this->em->persist($user);

		return $user;
	}

	/**
	 * @param string $email
	 * @param $password
	 */
	public function sendInvitationEmail(
		string $email,
		$password
	): void
	{
		$masterProject = $this->masterProjectFactory->create();
		$latte = $this->latteFactory->create();

		if ($this->environment->isNapojSe()) {
			$layout = __DIR__ . '/../UI/Emails/@layout_napojse.latte';
			$template = __DIR__ . '/../UI/Emails/invitation_email_napojse.latte';
			$subject = $this->translator->translate('core.emails.invitation.napojse_subject');
		} else {
			$layout = __DIR__ . '/../UI/Emails/@layout.latte';;
			$template = __DIR__ . '/../UI/Emails/invitation_email.latte';
			$subject = $this->translator->translate('core.emails.invitation.integroid_subject');
		}

		$body = $latte->renderToString(
			$template,
			array_merge([
				'project' => $masterProject,
				'email' => $email,
				'password' => $password,
			],
				['layout' => $layout]
			)
		);
		$message = new \Nette\Mail\Message();
		$message->setHeader('IsTransactional', 'True');
		$message->setFrom($this->applicationEmail);
		$message->addTo($email);
		$message->setHtmlBody($body);
		$message->setSubject($subject);
		$this->mailer->send($message);
	}
}