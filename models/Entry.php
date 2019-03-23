<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
/**
 * This is the model class for table "{{%entry}}".
 *
 * @property string $fname
 * @property string $lname
 * @property string $email
 * @property string $marks
 * @property string $status
 * @property resource $image
 */
class Entry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%entry}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['fname'], 'required'],
            [['image'], 'string'],
            [['fname', 'lname', 'email', 'marks', 'status'], 'string', 'max' => 45],
            [['fname'], 'unique'],
            [['fname'], 'required','message' => 'Please enter First Name.'],
            [['lname'], 'required','message' => 'Please enter Last Name.'],
            [['email'], 'required','message' => 'Please enter Email Address.'],
            ['email','email','message' => 'Please enter valid Email Address.'],
           [['image'],'file', 'extensions' =>'png,jpg,jpeg','message' => 'Only JPEG and PNG images are allowed!'],
            [['marks'], 'required','message' => 'Please enter Marks.'],
            [['marks'],'integer', 'min' => 0, 'max' => 100,'message' => 'Please enter valid value.'],
            [['status'], 'required','message' => 'Please enter Status']
        ];
    }



    public function showImage($fname) {
        echo Html::img('@web/uploads/sh.png', ['class' => 'pull-left img-responsive']);

        }

    public function attributeLabels()
    {
        return [
            'fname' => Yii::t('app', 'First Name'),
            'lname' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email Address'),
            'marks' => Yii::t('app', 'Marks'),
            'status' => Yii::t('app', 'Status'),
            'image' => Yii::t('app', 'Profile Picture'),
        ];
    }
}
