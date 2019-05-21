<?php

namespace Lxj\Laravel\AliyunSms;

use AlibabaCloud\Client\AlibabaCloud;
use Illuminate\Support\Facades\Log;

class Sms
{
    private $apiVersion;

    /**
     * Sms constructor.
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    public function __construct()
    {
        $this->apiVersion = config('sms.aliyun.api_version');

        $accessKeyId = config('sms.aliyun.access_key_id');
        $accessSecret = config('sms.aliyun.access_secret');
        $regionId = config('sms.aliyun.region_id');

        AlibabaCloud::accessKeyClient($accessKeyId, $accessSecret)
            ->regionId($regionId)// replace regionId as you need
            ->name('sms');

        app()->singleton(static::class, function () {
            return $this;
        });
    }

    /**
     * Create a rpc request
     *
     * @param $action
     * @param string $method
     * @return \AlibabaCloud\Client\Request\RpcRequest
     * @throws \AlibabaCloud\Client\Exception\ClientException
     */
    private function rpc($action, $method = 'POST')
    {
        return AlibabaCloud::rpc()
            ->product('Dysmsapi')
            // ->scheme('https') // https | http
            ->version($this->apiVersion)
            ->client('sms')
            ->action($action)
            ->method($method);
    }

    /**
     * Send message
     *
     * @param Message $message
     * @return bool
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    public function send(Message $message)
    {
        $request = $this->rpc('SendSms')
            ->options([
                'query' => $message->toArray(),
            ])
            ->request();

        if (!($result = $request->isSuccess())) {
            Log::error($request->toJson());
        }

        return $result;
    }
}
