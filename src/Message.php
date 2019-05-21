<?php

namespace Lxj\Laravel\AliyunSms;

class Message
{
    private $properties;

    public function setPhoneNumbers($phoneNumbers)
    {
        $this->properties['PhoneNumbers'] = $phoneNumbers;
        return $this;
    }

    public function setSignName($signName)
    {
        $this->properties['SignName'] = $signName;
        return $this;
    }

    public function setTemplateCode($templateCode)
    {
        $this->properties['TemplateCode'] = $templateCode;
        return $this;
    }

    public function setTemplateParam($templateParam)
    {
        $this->properties['TemplateParam'] = $templateParam;
        return $this;
    }

    public function setSmsUpExtendCode($smsUpExtendCode)
    {
        $this->properties['SmsUpExtendCode'] = $smsUpExtendCode;
        return $this;
    }

    public function setOutId($outId)
    {
        $this->properties['OutId'] = $outId;
        return $this;
    }

    public function setRegionId($regionId)
    {
        $this->properties['RegionId'] = $regionId;
        return $this;
    }

    public function toArray()
    {
        return $this->properties;
    }
}
