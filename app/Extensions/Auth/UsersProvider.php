<?php
/**
 * Project: saturn
 * File:    TokenToUserProvider.php
 * Date:    2019 - 12 - 18
 * Time:    10:19
 *
 * @author           Jorge Leonardo Ramirez Montoya <lramirez@sugit.com.ar>
 * @version          2019
 *
 */


namespace App\Extensions\Auth;


use App\Models\User;
use Closure;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Support\Arrayable;

class UsersProvider extends EloquentUserProvider
{
    public function __construct(HasherContract $hasher, User $user)
    {
        $this->model = $user;
        $this->hasher = $hasher;
    }

    public function retrieveByCredentials(array $credentials)
    {

        if (empty($credentials) ||
            (count($credentials) === 1 &&
                str_contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery($this->model);

        foreach ($credentials as $key => $value) {
            if (str_contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

}
