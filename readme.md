# 1.简介
* 语音识别功能调用自我封装的[pinkong/baidu-speech-recognition](https://packagist.org/packages/pinkong/baidu-speech-recognition)
* 语音识别涉及到转码和调用百度api，是非常耗时的操作。为了提高并发量，使用了swoole库。

# 2.安装
```
git@github.com:PINKONG/speech_recognition_server.git
cd speech_recognition_server
composer install

```

# 3.修改配置项
* swool配置： config目录下的http.php文件，要配置host和port.
* 百度语音识别api配置：需要到百度云后台注册一个语音识别的app，获取appid，appkey，secret等，填写到config目录下的baiduspeech.php文件.

# 4.启动与关闭
```$xslt
php artisan swool:http start
php artisan swool:http stop

```

# 5.使用
使用post，接口为/api/v1/voice/recognization. 要识别的语音文件附在data的「voice_file」字段中。

返回：
````
{
    "err_no": 0,
    "result": [
        "新年新气象，"
    ],
    "err_msg": "success"
}

```
注意result是个数组，最多5个.

