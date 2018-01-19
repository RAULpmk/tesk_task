<?php


namespace app\models;


use yii\db\ActiveRecord;

class Time extends ActiveRecord
{
    public $fullName;
    public $factTimeFrom;
    public $factTimeTo;

    public static function tableName() {
        return 'time';
    }

    public function getCoach() {
        return $this->hasOne(Coach::className(), ['id' => 'coach_id']);
    }

    public function getFullName() {
        return $this->coach->last_name . ' ' . $this->coach->first_name . ' ' . $this->coach->middle_name;
    }

    public function rules() {
        return [
            ['fullName', 'string', 'min' => 3],
            [['factTimeFrom', 'factTimeTo'], 'string', 'min' => 8]
        ];
    }

    public function attributeLabels() {
        return [
            'plan_time' => 'Запланированное время',
            'fact_time' => 'Фактическое время',
            'over_time' => 'Внеурочное время',
            'fullName' => 'ФИО',
            'factTimeFrom' => 'Начальное значение фактического времени',
            'factTimeTo' => 'Конечное значение фактического времени',
        ];
    }
}