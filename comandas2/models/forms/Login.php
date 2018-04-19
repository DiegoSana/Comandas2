<?php
namespace app\models\forms;

use Yii;
use app\models\User;

class Login extends \mdm\admin\models\form\Login {

    private $_user = false;
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}