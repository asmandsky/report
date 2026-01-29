<?php

class UserIdentity extends CUserIdentity
{
    /** @var CList|mixed|string */
    private $_id;

    /**
     * @return bool
     */
    public function authenticate()
    {
        $user = User::model()->findByAttributes(array('username' => $this->username));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($user->password !== md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * @return CList|mixed|string
     */
    public function getId()
    {
        return $this->_id;
    }
}
