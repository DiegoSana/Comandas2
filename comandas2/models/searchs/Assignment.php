<?php
namespace app\models\searchs;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Assignment extends \mdm\admin\models\searchs\Assignment {
    public $empresa_id;

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['empresa_id', 'safe']
            ]
        );
    }

    /**
     * Create data provider for Assignment model.
     * @param  array                        $params
     * @param  \yii\db\ActiveRecord         $class
     * @param  string                       $usernameField
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $class, $usernameField)
    {
        $query = $class::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $usernameField, $this->username]);
        $query->andFilterWhere(['empresa_id' => $this->empresa_id]);

        return $dataProvider;
    }
}