<?php
/**
 * Created by zhengyu.
 * Date: 17/12/5
 */

namespace App\Http\Requests;

use Illuminate\Http\Request as BaseRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\MainException;
use Validator as HttpValidator;

class Request extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 自定义错误格式
     *
     * @param Validator $validator
     * @return void
     * @throws
     */
    protected function failedValidation(Validator $validator)
    {
        throw MainException::paramsErrorException($validator->errors()->first());
    }


    /**
     * 传入rules,验证参数
     *
     * @param [type] $request
     * @param [type] $rules
     * @return void
     * @throws
     */
    static public function makeValidation($request, $rules)
    {
        //参数验证
        $validator = HttpValidator::make($request->all(), $rules);
        if ($validator->fails()) { //验证失败
            throw MainException::paramsErrorException($validator->errors()->first());
        }
    }

}
