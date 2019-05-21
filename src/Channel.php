<?php

namespace Lxj\Laravel\AliyunSms;

use Illuminate\Notifications\Notification;

class Channel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var Sms $sms */
        $sms = app(Sms::class);
        $sms->send($notification->toAliyunSms($notifiable));
    }
}
