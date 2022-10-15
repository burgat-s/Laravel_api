<?php

namespace App\Extensions\Auth;

use App\Exceptions\Api\UnauthorizedException;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Modules\Auth\Services\V1\UsersService;

class UsersGuard implements Guard
{
    use GuardHelpers;
    private $email = '';
    private $password = '';
    private $request;
    const USERS_GUARD = 'UsersGuard';

    public function __construct (UsersProvider $provider, Request $request, $configuration)
    {
        $this->provider = $provider;
        $this->request = $request;

        // key to check in request
        $this->email = isset($configuration['email']) ? $configuration['email'] : 'email';
        $this->password = isset($configuration['password']) ? $configuration['password'] : 'password';

    }

    public function user ()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }
        $user = null;

        $credentials = $this->getCredentialsFromRequest();
        if (!empty($credentials)) {
            $user = $this->provider->retrieveByCredentials($credentials);
        }
        return $this->user = $user;
    }

    public function getCredentialsFromRequest()
    {
        $credentials['email'] = $this->request->post($this->email);
        $credentials['password'] = $this->request->post($this->password);

        if (empty($credentials)) {
            return null;
        }

        return $credentials;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     *
     * @return bool
     */
    public function validate (array $credentials = [])
    {
        if (empty($credentials[$this->email]) || empty($credentials[$this->email])) {
            return false;
        }
        $credentials = [ $this->storageKey => $credentials[$this->password] ];
        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }
        return false;
    }

    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function attempt(array $credentials = [])
    {
        UsersService::verifiUserAttempts($credentials['email']);

        $user = $this->provider->retrieveByCredentials($credentials);
        if ($this->hasValidCredentials($user, $credentials)) {
            UsersService::verifiUserStatus($user);
            $this->user = $user;
            UsersService::resetAttempts($user);
            return true;
        }
        UsersService::failedAttempts($credentials['email']);
        throw new UnauthorizedException("Usuario o contraseña erroneo.");
    }

    /**
     * Determine if the user matches the credentials.
     *
     * @param  mixed  $user
     * @param  array  $credentials
     * @return bool
     */
    protected function hasValidCredentials($user, $credentials)
    {
        return ! is_null($user) && $this->provider->validateCredentials($user, $credentials);
    }
}
