<?php
namespace Sellastica\Integroid\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;
use Sellastica\AdminUI\User\Model\AdminUserRole;
use Sellastica\Identity\Model\Contact;
use Sellastica\Identity\Model\Password;
use Sellastica\Identity\Model\InvalidLogin;

/**
 * @see IntegroidUser
 */
class IntegroidUserBuilder implements IBuilder
{
	use TBuilder;

	/** @var AdminUserRole */
	private $role;
	/** @var Contact */
	private $contact;
	/** @var string|null */
	private $bio;
	/** @var string|null */
	private $homepage;
	/** @var array */
	private $permissions = [];
	/** @var bool */
	private $visible = true;
	/** @var int|null */
	private $projectId;
	/** @var Password|null */
	private $password;
	/** @var InvalidLogin */
	private $invalidLogin;

	/**
	 * @param AdminUserRole $role
	 * @param Contact $contact
	 */
	public function __construct(
		AdminUserRole $role,
		Contact $contact
	)
	{
		$this->role = $role;
		$this->contact = $contact;
	}

	/**
	 * @return AdminUserRole
	 */
	public function getRole(): AdminUserRole
	{
		return $this->role;
	}

	/**
	 * @return Contact
	 */
	public function getContact(): Contact
	{
		return $this->contact;
	}

	/**
	 * @return string|null
	 */
	public function getBio()
	{
		return $this->bio;
	}

	/**
	 * @param string|null $bio
	 * @return $this
	 */
	public function bio(string $bio = null)
	{
		$this->bio = $bio;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getHomepage()
	{
		return $this->homepage;
	}

	/**
	 * @param string|null $homepage
	 * @return $this
	 */
	public function homepage(string $homepage = null)
	{
		$this->homepage = $homepage;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getPermissions(): array
	{
		return $this->permissions;
	}

	/**
	 * @param array $permissions
	 * @return $this
	 */
	public function permissions(array $permissions)
	{
		$this->permissions = $permissions;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getVisible(): bool
	{
		return $this->visible;
	}

	/**
	 * @param bool $visible
	 * @return $this
	 */
	public function visible(bool $visible = true)
	{
		$this->visible = $visible;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getProjectId()
	{
		return $this->projectId;
	}

	/**
	 * @param int|null $projectId
	 * @return $this
	 */
	public function projectId(int $projectId = null)
	{
		$this->projectId = $projectId;
		return $this;
	}

	/**
	 * @return Password|null
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param Password|null $password
	 * @return $this
	 */
	public function password(Password $password = null)
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * @return InvalidLogin
	 */
	public function getInvalidLogin(): InvalidLogin
	{
		return $this->invalidLogin;
	}

	/**
	 * @param InvalidLogin $invalidLogin
	 * @return $this
	 */
	public function invalidLogin(InvalidLogin $invalidLogin)
	{
		$this->invalidLogin = $invalidLogin;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !IntegroidUser::isIdGeneratedByStorage();
	}

	/**
	 * @return IntegroidUser
	 */
	public function build(): IntegroidUser
	{
		return new IntegroidUser($this);
	}

	/**
	 * @param AdminUserRole $role
	 * @param Contact $contact
	 * @return self
	 */
	public static function create(
		AdminUserRole $role,
		Contact $contact
	): self
	{
		return new self($role, $contact);
	}
}