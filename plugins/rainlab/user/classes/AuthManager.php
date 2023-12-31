<?php namespace RainLab\User\Classes;

use Event;
use October\Rain\Auth\Manager as RainAuthManager;
use RainLab\User\Models\Settings as UserSettings;
use RainLab\User\Models\UserGroup as UserGroupModel;

/**
 * AuthManager
 */
class AuthManager extends RainAuthManager
{
    use \RainLab\User\Classes\AuthManager\HasBearerToken;

    /**
     * @var static instance
     */
    protected static $instance;

    /**
     * @var string sessionKey
     */
    protected $sessionKey = 'user_auth';

    /**
     * @var string userModel
     */
    protected $userModel = \RainLab\User\Models\User::class;

    /**
     * @var string groupModel
     */
    protected $groupModel = \RainLab\User\Models\UserGroup::class;

    /**
     * @var string throttleModel
     */
    protected $throttleModel = \RainLab\User\Models\Throttle::class;

    /**
     * init
     */
    public function init()
    {
        $this->useThrottle = UserSettings::get('use_throttle', $this->useThrottle);

        $this->requireActivation = UserSettings::get('require_activation', $this->requireActivation);

        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function extendUserQuery($query)
    {
        $query->withTrashed();

        // Extensibility
        Event::fire('rainlab.user.extendUserAuthQuery', [$query]);
    }

    /**
     * {@inheritDoc}
     */
    public function register(array $credentials, $activate = false, $autoLogin = true)
    {
        if ($guest = $this->findGuestUserByCredentials($credentials)) {
            return $this->convertGuestToUser($guest, $credentials, $activate);
        }

        return parent::register($credentials, $activate, $autoLogin);
    }

    /**
     * findUserByEmail finds a user by the email value, which includes
     * deactivated (trashed) user records.
     * @param string $email
     * @return Authenticatable|null
     */
    public function findUserByEmail($email)
    {
        if (!$email) {
            return null;
        }

        $query = $this->createUserModelQuery();

        $user = $query->where('email', $email)->first();

        return $this->validateUserModel($user) ? $user : null;
    }

    //
    // Guest users
    //

    /**
     * findGuestUserByCredentials
     */
    public function findGuestUserByCredentials(array $credentials)
    {
        if ($email = array_get($credentials, 'email')) {
            return $this->findGuestUser($email);
        }

        return null;
    }

    /**
     * findGuestUser
     */
    public function findGuestUser($email)
    {
        $query = $this->createUserModelQuery();

        return $query
            ->where('email', $email)
            ->where('is_guest', 1)
            ->first()
        ;
    }

    /**
     * registerGuest a guest user by giving the required credentials.
     *
     * @param array $credentials
     * @return Models\User
     */
    public function registerGuest(array $credentials)
    {
        $user = $this->findGuestUserByCredentials($credentials);
        $newUser = false;

        if (!$user) {
            $user = $this->createUserModel();
            $newUser = true;
        }

        $user->fill($credentials);
        $user->is_guest = true;
        $user->save();

        // Add user to guest group
        if ($newUser && $group = UserGroupModel::getGuestGroup()) {
            $user->groups()->add($group);
        }

        // Prevents revalidation of the password field
        // on subsequent saves to this model object
        $user->password = null;

        return $this->user = $user;
    }

    /**
     * convertGuestToUser converts a guest user to a registered user.
     *
     * @param Models\User $user
     * @param array $credentials
     * @param bool $activate
     * @return Models\User
     */
    public function convertGuestToUser($user, $credentials, $activate = false)
    {
        $user->fill($credentials);
        $user->convertToRegistered(false);

        // Remove user from guest group
        if ($group = UserGroupModel::getGuestGroup()) {
            $user->groups()->remove($group);
        }

        if ($activate) {
            $user->attemptActivation($user->getActivationCode());
        }

        // Prevents revalidation of the password field
        // on subsequent saves to this model object
        $user->password = null;

        return $this->user = $user;
    }
}
