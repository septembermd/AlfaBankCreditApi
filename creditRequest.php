<?php
/**
 * Created by PhpStorm.
 * User: <Victor Davydov> septembermd@gmail.com
 * Date: 4/1/15
 * Time: 4:36 PM
 *
 * Пример работы c API
 */

/**
 * Autoload classes
 */
spl_autoload_register(function($className) {
    $namespace = str_replace("\\", "/", __NAMESPACE__);
    $className = str_replace("\\","/",$className);
    $class= (empty($namespace)?"":$namespace."/")."{$className}.php";
    include_once($class);
});

/**
 * Required configuration parameters
 *
 * @var array
 */
$config = array(
    'email' => 'me@example.ru',
    'tradePointPhone' => '78000000000',
    'INN' => '1234567890',
    'tradeSite' => '123456',
    'userId' => ''
);


use AlfaCreditApi\CreditRequest;
use AlfaCreditApi\Specification;
use AlfaCreditApi\AlfaCreditApi;

$specification = new Specification();
$creditRequest = new CreditRequest();

$title = "Test title";
$amount = 1;
$price = 1000;
$category = "TEST_CAT";

$specification
    // В данном теге должен быть передан код категории товара из справочника (см. Приложение 1 – Excel файл), предоставленного Банком интернет-магазину.
    // Необязательный атрибут с ограничением на длину поля до 40 символов.
    ->setCategory($category)
    //В данном теге должен быть передан код товара. Значение на усмотрение интернет-магазина (строка до 20-ти символов).
    // Необязательный атрибут с ограничением на длину поля до 20 символов.
    ->setCode('#123')
    // Описание товара (до 50-ти символов)
    // Необязательный атрибут с ограничением на длину поля до 50 символов.
    ->setDescription($title)
    ->setAmount($amount)
    ->setPrice($price);

$creditRequest
    // Поле передается только для полной анкеты!!! В данном теге необходимо передавать сумму первоначального (не более 15-ти символов) взноса по кредиту (в рублях, без копеек)
    // Необязательный атрибут с ограничением на длину поля до 15 символов
    ->setFirstPayment(1000)
    ->setINN($config['INN'])
    ->setTradePointPhone($config['tradePointPhone'])
    ->setEmail($config['email'])
    // В данном теге необходимо передавать уникальный код магазина. У каждого партнера это свой уникальный номер (будет сгенерирован и выcлан для каждого партнера).
    ->setTradeSite($config['tradeSite'])
    // Необязательный атрибут с ограничением на длину поля до 10 символов.
    ->setUserId($config['userId'])
    ->setReference(uniqid())
    // В данном поле мы ожидаем передачу срока кредита в месяцах
    // Необязательный атрибут с численным значением
    ->setCreditPeriod(12)
    ->addSpecification($specification);

$api = new AlfaCreditApi($creditRequest);
$response = $api->getResponse();
?>
<!doctype>
<html>
<head>
    <meta charset="utf-8">
    <title>Редкирект на заявку в АльфаБанк</title>
    <script>
        window.onload = function() {
            document.forms["requestForm"].submit();
        };
    </script>
</head>
<body>
<p>Вы будете автоматически перенаправлены на сайт АльфаБанк для заполнения заявки на кредит.</p>
<form id="requestForm" name="requestForm" action="<?php echo AlfaCreditApi::ENDPOINT ?>" method="post">
    <input type="hidden" name="InXML" value="<?php echo $api->getCreditRequestAsXML();?>"/>
    <input type="submit" value="Перейти к заполнении заявки"/>
</form>
</body>
</html>



