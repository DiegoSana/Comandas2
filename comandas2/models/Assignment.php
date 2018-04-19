<?php
namespace app\models;

use mdm\admin\components\Configs;
use Yii;

class Assignment extends \mdm\admin\models\Assignment {

    /**
     * Get all available and assigned roles/permission
     * @return array
     */
    public function getItems()
    {
        $manager = Configs::authManager();
        $available = [];
        foreach (array_keys($manager->getRoles()) as $name) {
            $available[$name] = 'role';
        }

        foreach (array_keys($manager->getPermissions()) as $name) {
            if ($name[0] != '/') {
                $available[$name] = 'permission';
            }
        }

        $assigned = [];
        foreach ($manager->getAssignments($this->id) as $item) {
            $assigned[$item->roleName] = $available[$item->roleName];
            unset($available[$item->roleName]);
        }

        if(!Yii::$app->user->can('admin')) {
            $_available = [];
            foreach ($available as $key => $_item) {
                if (strpos($key, '#' . Yii::$app->user->identity->empresa_id . '_') !== false) {
                    $_available[$key] = $_item;
                }
            }
            $_assigned = [];
            foreach ($assigned as $key => $_item) {
                if (strpos($key, '#' . Yii::$app->user->identity->empresa_id . '_') !== false) {
                    $_assigned[$key] = $_item;
                }
            }
        }

        return [
            'available' => isset($_available) ? $_available : $available,
            'assigned' => isset($_assigned) ? $_assigned : $assigned,
        ];
    }
}