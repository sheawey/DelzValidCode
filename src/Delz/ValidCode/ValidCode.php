<?php

namespace Delz\ValidCode;


/**
 * 验证码数据模型类
 *
 * 模型要支持序列化，才能将对象保存到缓存系统
 *
 * @package Delz\ValidCode
 */
class ValidCode implements \Serializable
{
    /**
     * 命名空间
     *
     * 区别于不同的验证服务，如：
     * 用户注册：namespace = register
     * 用户找回密码：namespace = forget
     *
     * @var string
     */
    protected $namespace;

    /**
     * 验证码
     *
     * @var string
     */
    protected $code;

    /**
     * 验证码超时时间
     *
     * @var \DateTime
     */
    protected $expiredAt;

    /**
     * 验证码接收者
     *
     * 如果是手机，就是手机号码，如果是邮箱，就是邮箱地址
     *
     * @var string
     */
    protected $recipient;

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return \DateTime
     */
    public function getExpiredAt()
    {
        return $this->expiredAt;
    }

    /**
     * @param \DateTime $expiredAt
     */
    public function setExpiredAt(\DateTime $expiredAt)
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * 验证码是否过期
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expiredAt < new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize([
            'namespace' => $this->namespace,
            'recipient' => $this->recipient,
            'expiredAt' => $this->expiredAt,
            'code' => $this->code
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($data)
    {
        $arr = unserialize($data);
        $this->namespace = $arr['namespace'];
        $this->recipient = $arr['recipient'];
        $this->expiredAt = $arr['expiredAt'];
        $this->code = $arr['code'];
    }
}