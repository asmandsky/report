<?php
class LoginForm extends CFormModel
{
    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /** @var bool */
    public $rememberMe;

    /** @var UserIdentity */
    private $_identity;

    /**
     * @return array[]
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('rememberMe', 'boolean'),
            array('password', 'authenticate'),
        );
    }

    /**
     * @param string $attribute
     * @param array $params
     * @return void
     * @throws CException
     */
    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate()) {
            $this->addError($attribute, 'Неверное имя пользователя или пароль.');
        }
    }

    /**
     * @return bool
     * @throws CException
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600*24*30 : 0;
            Yii::app()->user->login($this->_identity, $duration);

            return true;
        }

        return false;
    }
}
