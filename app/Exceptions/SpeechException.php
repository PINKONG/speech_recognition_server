<?php
namespace App\Exceptions;

use Pinkong\BaiduSpeechRecognition\Exceptions\Exception;
use Illuminate\Support\Facades\Log;


class MainException
{
    //服务器异常
    public static function invalidServe()
    {
        return new Exception('服务器繁忙', $code = 10001);
    }

    //上传文件不存在
    public static function fileDoesntFound()
    {
        return new Exception('请先上传文件', $code = 10002);
    }

    //上传文件不可用
    public static function invalidFile()
    {
        return new Exception('上传文件出错', $code = 10003);
    }

    //上传文件格式不可用
    public static function invalidFileFormat()
    {
        return new Exception('上传文件格式不正确', $code = 10004);
    }

     //非法操作
    public static function unlegalControl($msg=null)
    {
        return new Exception($msg?$msg:'非法操作', $code = 10005);
    }

    //参数异常
    public static function paramsErrorException($msg)
    {
        return new Exception($msg, $code = 10006, $httpCode = 422);
    }

    public static function shellExecuteFailException($msg='无法调用FFmepg转码')
    {
        return new Exception($msg, $code = 10007);
    }

    public static function exceptionFromGuzzleException($exception)
    {
        $response = $exception->getResponse();
        $message = $exception->getMessage();
        $statuscode = $response->getStatusCode();

        $responseBodyAsString = $response->getBody()->getContents();
        $rawResponse = json_decode($responseBodyAsString, true);
        if ($rawResponse && $rawResponse['meta']) {
            return new Exception($rawResponse['meta']['message'], $rawResponse['meta']['code']);
        }
        if ($statuscode == 429) {
            return self::invalidServe();
        }
        if ($statuscode == 500) {
            return self::invalidServe();
        }

        return new Exception($message, 400);
    }
}