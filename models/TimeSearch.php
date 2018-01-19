<?php


namespace app\models;

use yii\data\ActiveDataProvider;
use app\models\Time;

class TimeSearch extends Time
{
    public $limit;

    public function rules() {
        return [
            [['id', 'coach_id', 'limit'], 'integer'],
            [['plan_time', 'fact_time', 'over_time', 'fullName'], 'safe'],
            ['fullName', 'string', 'min' => 3],
            [['factTimeFrom', 'factTimeTo'], 'string', 'min' => 8],
        ];
    }

    public function search($params) {
        $query = Time::find();
        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith(['coach']);
        if ($this->fullName != '') {
            $query->andFilterWhere(['like', 'concat_ws(" ", last_name, first_name, middle_name)', $this->fullName]);
        }
        if ($this->factTimeFrom != '') {
            $query->andFilterWhere(['>=', 'fact_time', $this->factTimeFrom]);
        }
        if ($this->factTimeTo != '') {
            $query->andFilterWhere(['<=', 'fact_time', $this->factTimeTo]);
        }

        return $dataProvider;
    }

}