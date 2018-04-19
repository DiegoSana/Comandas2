<?php
namespace app\models\forms;

use yii\helpers\ArrayHelper;

class Signup extends \mdm\admin\models\form\Signup {
    public $empresa_id;

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['username', 'required'],
            ]
        );
    }
}