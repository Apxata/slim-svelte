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

    public function findBySessionToken(string $session_id): bool|array
    {
        return $this->loginQuery->findByToken($session_id);
    }
}