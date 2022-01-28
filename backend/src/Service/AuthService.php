<?php


namespace App\Service;


use App\Model\Access\LoginCommand;
use App\Model\Access\LoginQuery;
use Ramsey\Uuid\Uuid;

class AuthService
{
    private LoginCommand $loginCommand;
    private LoginQuery $loginQuery;


    /**
     * AuthService constructor.
     */
    public function __construct(
        LoginCommand $loginCommand,
        LoginQuery $loginQuery
    )
    {
        $this->loginCommand = $loginCommand;
        $this->loginQuery = $loginQuery;
    }

    public function setAuthCookie(int $user_id): bool
    {
        $cookieId = Uuid::uuid4()->toString();
        $_SESSION['user_id'] = $cookieId;
        $time_now = time();
        $max_age = $time_now + (60 * 60 * 24 * 30);

        $date_now = date('Y-m-d H:i:s', $time_now);
        $date_max_age = date('Y-m-d H:i:s', $max_age);

        $cookieSet = setcookie('session_id', $cookieId, $max_age, "/");

        if($cookieSet){
            $this->loginCommand->createToken($user_id, $cookieId, $date_now, $date_max_age);
            return true;
        }
        return false;
    }

    public function createTokenForUser(int $user_id): bool|string
    {
        $tokenId = Uuid::uuid4()->toString();

        $time_now = time();
        $max_age = $time_now + (60 * 60 * 24 * 30);

        $date_created = date('Y-m-d H:i:s', $time_now);
        $date_expired = date('Y-m-d H:i:s', $max_age);
        try {
            $this->loginCommand->createToken($user_id, $tokenId, $date_created, $date_expired);

            return $tokenId;
        } catch (\Exception $exception) {
            //TODO log error
            return false;
        }


    }

    public function findBySessionToken(string $session_id): bool|array
    {
        return $this->loginQuery->findByToken($session_id);
    }

    public function isSessionTokenValid(string $session_id): bool
    {
        $user = $this->findBySessionToken($session_id);
        if(!$user) {
           return false;
        }
        $time_now = time();
        $expired = strtotime($user['date_expired']);
        if($time_now < $expired ) {
            return true;
        } else {
            return false;
        }
    }

    public function isAccessGranted(string $token, string $role_for_access): bool
    {
        $user = $this->findBySessionToken($token);
        if($user['role'] === $role_for_access) {
            return true;
        }else{
            return false;
        }
    }
}