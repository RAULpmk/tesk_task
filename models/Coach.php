<?php


namespace app\models;


use yii\db\ActiveRecord;

class Coach extends ActiveRecord
{
    public static function tableName() {
        return 'coach';
    }

    public function getTimes() {
        return $this->hasMany(Time::className(), ['coach_id' => 'id']);
    }

    public function getFullName() {
        return $this->last_name;
    }

    public function attributeLabels() {
        return [
            'fullName' => 'ФИО'
        ];
    }

    public function rules() {
        return [
            [['first_name', 'middle_name', 'last_name'], 'string', 'max' => 30],
        ];
    }
}