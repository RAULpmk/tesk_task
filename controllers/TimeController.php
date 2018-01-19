<?php


namespace app\controllers;


use app\models\Coach;
use app\models\TimeSearch;
use yii\web\Controller;
use Yii;

class TimeController extends Controller
{

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionShow() {
        $post = Yii::$app->request->post();
        if (isset($post['act']) && $post['act'] == 1) {
            // Очищаем данные
            Yii::$app->db->createCommand()->truncateTable('time')->execute();
            // Генерируем тестовые данные
            $num_data = $this->generateData();
            Yii::$app->session->setFlash('success', 'Количество добавленных строк: ' . $num_data);
        }

        // формируем данные для страницы
        $get = Yii::$app->request->get();
        $searchModel = new TimeSearch();
        $dataProvider = $searchModel->search($get);
        $dataProvider->setPagination(['pageSize' => max(10, (int)$searchModel->limit)]);
        $numActiveRecords = $dataProvider->getTotalCount();

        // формируем данные для диаграммы
        /*$arr_diagram = $dataProvider->getModels();
        $num_diagram_elem = count($arr_diagram);
        $arr_coaches = array();
        for ($i = 0; $i < $num_diagram_elem; $i++) {
            $arr_coaches[] = $arr_diagram[$i]['coach']['last_name'] .' '.$arr_diagram[$i]['coach']['first_name'].' '.$arr_diagram[$i]['coach']['middle_name'];
            $arr_times['plan_time'][] = strtotime($arr_diagram[$i]['plan_time']);
            $arr_times['fact_time'][] = $arr_diagram[$i]['fact_time'];
            $arr_times['over_time'][] = $arr_diagram[$i]['over_time'];
        }*/

        return $this->render('show', compact('dataProvider', 'searchModel', 'numActiveRecords', 'arr_coaches', 'arr_times'));
    }

    public function generateData() {
        // получаем данные по тренерам
        $all_coach = Coach::find()->select('id')->asArray()->all();
        $num_coach = count($all_coach);

        // формируем данные для занесения в базу данных
        $data = array();
        $num_data = 100;
        for ($i = 0; $i < $num_data; $i++) {
            $coach_index = rand(0, $num_coach - 1);
            $times = array();
            for ($j = 0; $j < 3; $j++) {
                $hour = rand(0, 23);
                $minute = rand(0, 59);
                $second = rand(0, 59);
                $times[$j] = date('H:i:s', mktime($hour, $minute, $second));
            }
            $data[$i] = array($all_coach[$coach_index]['id'], $times[0], $times[1], $times[2]);
        }
        // заносим данные в БД
        $num_rows = Yii::$app->db->createCommand()->batchInsert('time', ['coach_id', 'plan_time', 'fact_time', 'over_time'], $data)->execute();

        return $num_rows;
    }
}