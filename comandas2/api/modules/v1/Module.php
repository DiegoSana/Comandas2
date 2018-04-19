<?php
// Check this namespace:
namespace app\api\modules\v1;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        //var_dump(\Yii::$app->getRequest()->getHostName());
        \Yii::setAlias('@web', '/web');
        if(isset(\Yii::$app->getRequest()->queryParams['aplicacion_id'])) {
            \Yii::$app->params['aplicacion_id'] = \Yii::$app->getRequest()->queryParams['aplicacion_id'];
        }
        // ...  other initialization code ...
    }
}