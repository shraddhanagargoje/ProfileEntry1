<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\Connection;
use yii\db\ActiveRecord;
class EntryForm extends ActiveRecord
{
public $fname;
public $lname;
public $email;
public $imageFile;
public $marks;
public $status;

public static function tableName(){
	
	return '{{%Entry}}';
}
    public function transactions()
    {
        return [
            'admin' => self::OP_INSERT,
            'api' => self::OP_INSERT | self::OP_UPDATE | self::OP_DELETE,
            // the above is equivalent to the following:
            // 'api' => self::OP_ALL,
        ];
    }

 public function rules()
    {
        return [
            [['fname'], 'required','message' => 'Please enter First Name.'],
			[['lname'], 'required','message' => 'Please enter Last Name.'],
			[['email'], 'required','message' => 'Please enter Email Address.'],
			['email','email','message' => 'Please enter valid Email Address.'],
			//[['imageFile'],'file','skipOnEmpty' => false, 'extensions' =>'png,jpg,jpeg','message' => 'Image is not valid'],
			[['marks'], 'required','message' => 'Please enter Marks.'],
			[['marks'],'integer', 'min' => 0, 'max' => 100,'message' => 'Please enter valid value.'],
			[['status'], 'required','message' => 'Please enter Status']

        ];
    }
	  public function upload() {
         if ($this->validate()) {
            $this->imageFile->saveAs('../uploads/' . $this->imageFile->baseName . '.' .
               $this->imageFile->extension);
            return true;
         } else {
            return false;
         }
      }
}