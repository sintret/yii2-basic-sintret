<?php

/*
  // Global function:
  $component->on($eventName, 'functionName');

  // Model and method names:
  $component->on($eventName, ['Modelname', 'functionName']);

  // Object and method name:
  $component->on($eventName, [$obj, 'functionName']);

  // Anonymous function:
  $component->on($eventName, function ($event) {
  // Use $event.
  });
 * and open the template in the editor.
 */

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use \app\models\User;

class Util extends Component {

    public $beforeBody;
    public $afterBody;
    public $member;
    public $tab = 1;

    const PUBLISH = 1;
    const UNPUBLISH = 0;

    public function publish() {
        return ['Unpublish', 'Publish'];
    }

    public function publishLabel($int) {
        $array = $this->publish();
        if ($int == 1)
            $class = 'success';
        else
            $class = 'default';

        return '<div class="label label-' . $class . '">' . $array[$int] . '</div>';
    }

    public function say() {
        return 'haiii';
    }

    public function getUserId($id = 0) {
        if ($id)
            return User::find()->where(['id' => $id])->one();
    }

    public function randomString($length = 10, $chars = '', $type = array()) {
        $alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
        $alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';
        $othr = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";
        $characters = "";
        $string = '';
        isset($type['alphaSmall']) ? $type['alphaSmall'] : $type['alphaSmall'] = true;
        isset($type['alphaBig']) ? $type['alphaBig'] : $type['alphaBig'] = true;
        isset($type['num']) ? $type['num'] : $type['num'] = true;
        isset($type['othr']) ? $type['othr'] : $type['othr'] = false;
        isset($type['duplicate']) ? $type['duplicate'] : $type['duplicate'] = true;
        if (strlen(trim($chars)) == 0) {
            $type['alphaSmall'] ? $characters.=$alphaSmall : $characters = $characters;
            $type['alphaBig'] ? $characters.=$alphaBig : $characters = $characters;
            $type['num'] ? $characters.=$num : $characters = $characters;
            $type['othr'] ? $characters.=$othr : $characters = $characters;
        } else
            $characters = str_replace(' ', '', $chars);
        if ($type['duplicate'])
            for (; $length > 0 && strlen($characters) > 0; $length--) {
                $ctr = mt_rand(0, (strlen($characters)) - 1);
                $string.=$characters[$ctr];
            } else
            $string = substr(str_shuffle($characters), 0, $length);
        return $string;
    }

    public function randomCode() {
        $tokens = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 5; $j++) {
                $return .= $tokens[rand(0, 35)];
            }
            if ($i < 2) {
                $return .= '';
            }
        }
        return $return;
    }

    public function countUser() {
        return User::find()->count();
    }

    public function templateExcel() {
        return ("@webroot/templates/new.xls");
    }

    /**
     * For Custom report translate 0 ke A
     */
    public function excelChar() {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
            'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
            'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ',
            'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ',
            'EA', 'EB', 'EC', 'EE', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ',
        );
    }

    public function excelNot() {
        return [
            'userUpdate', 'userCreate', 'createDate', 'updateDate', 'image'
        ];
    }

    public function excelParsing($fileExcel) {
//        $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_sqlite3;  /* here i added */
//        $cacheEnabled = \PHPExcel_Settings::setCacheStorageMethod($cacheMethod);
//        if (!$cacheEnabled) {
//            echo "### WARNING - Sqlite3 not enabled ###" . PHP_EOL;
//        }
        $objPHPExcel = new \PHPExcel();

        //$fileExcel = Yii::getAlias('@webroot/templates/operator.xls');
        $inputFileType = \PHPExcel_IOFactory::identify($fileExcel);

        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);

        $objReader->setReadDataOnly(true);

        /**  Load $inputFileName to a PHPExcel Object  * */
        $objPHPExcel = $objReader->load($fileExcel);

        $total_sheets = $objPHPExcel->getSheetCount();

        $allSheetName = $objPHPExcel->getSheetNames();
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();

                $arraydata[$row - 1][$col] = $value;
            }
        }

        return $arraydata;
    }

    public static function Rp($price) {
        return number_format($price, 0, '.', ',');
    }

    public static function usernameOne($id) {
        $user = User::find()->select('username')->where(['id' => $id])->one();
        return $user->username;
    }
    
    public static function settings(){
        $model = \app\models\Setting::findOne(1);
        return $model;
    }

    public static function years() {
        $return = [];
        for ($i = 2015; $i <= date(Y) + 1; $i++) {
            $return[$i] = $i;
        }

        return $return;
    }

    public static $monthName = [1 => 'January', 'February', 'March', 'April', 'May', 'Juni', 'Juli', 'Augustus', 'September', 'October', 'November', 'December'];

    public static function months() {
        $return = [];
        for ($i = 1; $i <= 12; $i++) {
            $r = $i < 10 ? '0' . $i : $i;
            $return[$r] = self::$monthName[$i];
        }

        return $return;
    }
    
    public static function sendSms($to,$msg){
        if(self::settings()->sms==1){
            return self::sendSmsTo($to, $msg);
        }
    }

    public static function sendSmsTo($to, $msg) {
        $url = 'https://bulksms.vsms.net/eapi/submission/send_sms/2/2.0';
        $username = 'sintret';
        $password = 'apaajalagi';
        $fields = array(
            'username' => $username,
            'password' => $password,
            'message' => $msg,
            'msisdn' => $to
        );

        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);

        return $result;
    }

    public static function sendSms2($to, $msg) {
        $user = 'sintret';
        $password = 'PaVDeWFMIKBbRP';
        $url = 'http://api.clickatell.com/http/sendmsg?user=' . $user . '&password=' . $password . '&api_id=3565217&to=' . $to . '&text=' . $msg;

        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
    }

}
