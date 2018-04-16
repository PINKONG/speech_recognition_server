<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Request as HttpRequest;
use Pinkong\BaiduSpeechRecognition\Facades\SpeechHelper;


class SpeechController extends Controller
{

    /**
     * 识别语音
     *
     * @param Request $request
     * @return void
     * @throws
     */
    public function recognizeVoicePacket(Request $request)
    {
        HttpRequest::makeValidation($request, ['voice_file' => 'required|max:1024']);
        $file = $request->file('voice_file');

        //语音识别
        $recognitionResult = SpeechHelper::obtainVoiceText($file);

        return $recognitionResult;
    }


}
