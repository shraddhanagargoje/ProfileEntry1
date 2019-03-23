<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m190227_061349_test_table
 */
class m190227_061349_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     function safeUp()
    {
  $this->createTable("Entry", [
            "fname" => Schema::TYPE_STRING,
            "lname" => Schema::TYPE_STRING,
            "email" => Schema::TYPE_STRING,
			 "marks" => Schema::TYPE_STRING,
			  "status" => Schema::TYPE_STRING,
			  
         ]);
         $this->batchInsert("Entry", ["fname","lname", "email","marks","status"], [
            ["User1","last1", "user1@gmail.com","56","A"],
            ["User2","last2", "use1@gmail.com","58","B"],
         ]);
      }
    

    /**
     * {@inheritdoc}
     */
     function safeDown()
    {
        echo "m190227_061349_test_table cannot be reverted.\n";
 $this->dropTable('Entry');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_061349_test_table cannot be reverted.\n";

        return false;
    }
    */
}
