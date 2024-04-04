<?php
/**
 * Обработчик ошибок
 */
namespace core;

class ErrorHandler
{
public function __construct()
{
    if(DEBUG)
    {
        error_reporting(-1);
    }else
    {
        error_reporting(0);
    }
    set_exception_handler([$this, 'exceptionHandler']);
    set_error_handler([$this, 'errorHandler']);
    ob_start(); // включаем буферизацию вывода
    register_shutdown_function([$this, 'fatalErrorHandler']);
}

public function errorHandler($errorNumber, $errorString, $errorFile, $errorLine ): void
{
    $this->errorLog($errorFile, $errorString, $errorLine);
    $this->errorDisplay($errorNumber, $errorString, $errorFile, $errorLine);
}

public function fatalErrorHandler(): void
{
    $fatalError = error_get_last();
    if(!empty($fatalError) && $fatalError ['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
    {
        $this->errorLog($fatalError['massage'], $fatalError['file'], $fatalError['line']);
        ob_end_clean(); // очищаем буфер вывода и отключаем его
        $this->errorDisplay($fatalError['type'], $fatalError['massage'], $fatalError['file'], $fatalError['line']);
    }else
    {
        ob_end_flush(); // Сбрасывает (отправляет) возвращаемое значение активного обработчика вывода и отключает активный буфер вывода
    }

}

public function exceptionHandler(\Throwable $e) // Throwable является родительским интерфейсом для всех объектов, включая классы Error и Exception
{
    $this->errorLog($e->getMessage(), $e->getFile(), $e->getLine());
    $this->errorDisplay('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
}
protected function errorLog($message = '', $file = '', $line = '')
{
    file_put_contents(
        LOG . '/errors.log',
        "[" . date('Y-m-d H:i:s') . " ] Текст ошибки: $message | Фаил: $file | Строка: $line \n ====================\n",
        FILE_APPEND);
}
protected function errorDisplay($errorNumber, $errorString, $errorFile, $errorLine, $responseCode = 500)
{
    if($responseCode == 0)
    {
        $responseCode = 404;
    }
    http_response_code($responseCode);
    if($responseCode == 404 && !DEBUG)
    {
        require_once HTTP . '/errors/404.php';
        die;
    }
    if(DEBUG)
    {
        require_once HTTP . '/errors/development.php';
    }else
    {
        require_once HTTP . '/errors/production.php';
    }
    die;
}

}