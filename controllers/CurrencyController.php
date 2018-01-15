<?php


namespace app\controllers;

use app\models\Currency;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class CurrencyController extends Controller
{

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionShow() {
        $post = Yii::$app->request->post();
        if (isset($post['act']) && $post['act'] == 1) {
            // Очищаем данные
            Yii::$app->db->createCommand()->truncateTable('currency')->execute();
            // Загружаем содержимое файла
            $xml_data = simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp");
            // формируем данные для занесения в базу данных
            $data = array();
            $num_data = 0;
            foreach ($xml_data->Valute as $valute) {
                $data[$num_data] = array();
                $data[$num_data] = array((string)$valute['ID'], (string)$valute->NumCode, (string)$valute->CharCode, (int)$valute->Nominal, (string)$valute->Name, (float)str_replace(',','.',$valute->Value));
                $num_data++;
            }

            // заносим данные в БД
            $num_rows = Yii::$app->db->createCommand()->batchInsert('currency', ['valute_id', 'num_code', 'char_code', 'nominal', 'name', 'value'], $data)->execute();
            if ($num_rows == $num_data) {
                Yii::$app->session->setFlash('success', 'Количество добавленных строк: '.$num_data);
            }
            else {
                Yii::$app->session->setFlash('error', 'Количество добавленных строк ('.$num_rows.') не совпдает с количеством полученных данных ('.$num_data.')');
            }
        }

        // получаем данные из таблицы (они или уже загружены, или загрузились только что)
        $all_currency = Currency::find();
        $countQuery = clone $all_currency;
        // определяем постраничность
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'defaultPageSize' => 5
        ]);
        // выполняем запрос с учетом постраничности
        $currency = $all_currency->offset($pages->offset)->limit($pages->limit)->select('num_code, char_code, nominal, name, value')->asArray()->all();

        return $this->render('show', compact('currency', 'pages'));
    }
}