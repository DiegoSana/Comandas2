<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 18/04/18
 * Time: 14:02
 */

namespace app\behaviors;

use yii\helpers\BaseFileHelper;
use rico\yii2images\models\Image;

class ImageBehave extends \rico\yii2images\behaviors\ImageBehave
{

    /**
     *
     * Method copies image file to module store and creates db record.
     *
     * @param $absolutePath
     * @param bool $isMain
     * @return bool|Image
     * @throws \Exception
     */
    public function attachImage($absolutePath, $isMain = false, $name = '')
    {
        if(!preg_match('#http#', $absolutePath)){
            if (!file_exists($absolutePath)) {
                throw new \Exception('File not exist! :'.$absolutePath);
            }
        }else{
            //nothing
        }

        if (!$this->owner->primaryKey) {
            throw new \Exception('Owner must have primaryKey when you attach image!');
        }

        $pictureFileName =
            /*substr(md5(microtime(true) . $absolutePath), 4, 6)
            . '.' .
            pathinfo($absolutePath, PATHINFO_EXTENSION);*/
            substr(md5(microtime(true) . $absolutePath), 4, 6) .
            image_type_to_extension(getimagesize($absolutePath)[2]);
        $pictureSubDir = $this->getModule()->getModelSubDir($this->owner);
        $storePath = $this->getModule()->getStorePath($this->owner);

        $newAbsolutePath = $storePath .
            DIRECTORY_SEPARATOR . $pictureSubDir .
            DIRECTORY_SEPARATOR . $pictureFileName;

        BaseFileHelper::createDirectory($storePath . DIRECTORY_SEPARATOR . $pictureSubDir,
            0775, true);

        copy($absolutePath, $newAbsolutePath);

        if (!file_exists($newAbsolutePath)) {
            throw new \Exception('Cant copy file! ' . $absolutePath . ' to ' . $newAbsolutePath);
        }

        if ($this->getModule()->className === null) {
            $image = new Image;
        } else {
            $class = $this->getModule()->className;
            $image = new $class();
        }
        $image->itemId = $this->owner->primaryKey;
        $image->filePath = $pictureSubDir . '/' . $pictureFileName;
        $image->modelName = $this->getModule()->getShortClass($this->owner);
        $image->name = $name;

        $image->urlAlias = $this->getAlias($image);

        if(!$image->save()){
            return false;
        }

        if (count($image->getErrors()) > 0) {

            $ar = array_shift($image->getErrors());

            unlink($newAbsolutePath);
            throw new \Exception(array_shift($ar));
        }
        $img = $this->owner->getImage();

        //If main image not exists
        if(
            is_object($img) && get_class($img)=='rico\yii2images\models\PlaceHolder'
            or
            $img == null
            or
            $isMain
        ){
            $this->setMainImage($image);
        }


        return $image;
    }

    private function getImagesFinder($additionWhere = false)
    {
        $base = [
            'itemId' => $this->owner->primaryKey,
            'modelName' => $this->getModule()->getShortClass($this->owner)
        ];

        if ($additionWhere) {
            $base = \yii\helpers\BaseArrayHelper::merge($base, $additionWhere);
        }

        return $base;
    }

    /** Make string part of image's url
     * @return string
     * @throws \Exception
     */
    private function getAliasString()
    {
        if ($this->createAliasMethod) {
            $string = $this->owner->{$this->createAliasMethod}();
            if (!is_string($string)) {
                throw new \Exception("Image's url must be string!");
            } else {
                return $string;
            }

        } else {
            return substr(md5(microtime()), 0, 10);
        }
    }

    /**
     *
     * Обновить алиасы для картинок
     * Зачистить кэш
     */
    private function getAlias()
    {
        $aliasWords = $this->getAliasString();
        $imagesCount = count($this->owner->getImages());

        return $aliasWords . '-' . intval($imagesCount + 1);
    }
}