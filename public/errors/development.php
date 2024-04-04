<?php
/**
 * @var $errorNumber \core\ErrorHandler
 * @var $errorLine \core\ErrorHandler
 * @var $errorFile \core\ErrorHandler
 * @var $errorString \core\ErrorHandler
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки: </b><?= $errorNumber ?></p>
<p><b>Текст ошибки: </b><?= $errorString ?></p>
<p><b>Место ошибки: </b><?= $errorFile ?></p>
<p><b>Строка ошибки: </b><?= $errorLine ?></p>

</body>
</html>
