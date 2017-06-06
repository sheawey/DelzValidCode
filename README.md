# 验证码组件

    <?php

    use Delz\Cache\Provider\Apc;
    use Delz\ValidCode\Manager;
    

    //利用composer的autoload
    /** @var \Composer\Autoload\ClassLoader $loader */
    $loader = require __DIR__ . "/../vendor/autoload.php";
    
    //创建验证码
    $manager = new Manager(new Apc()); //用Apc缓存存储验证码，你可以用别的缓存
    $namespace = 'forget_password';//命名空间
    $recipient = '13812345678'; //发送对象，可以是手机号码，也可以是email等
    $expireIn = 300; //有效时间，单位为秒
    $length = 6; //验证码长度
    /**
      * 字符串类型
      * - alnum    - 字母和数字，默认 0-9A-Za-z
      * - alpha    - 字母 a-zA-Z
      * - hexdec   - 十六进制字符 0-9 a-f
      * - numeric  - 数字, 0-9
      * - nozero   - 非0数字, 1-9
      * - distinct - 去除数字和字母混淆的，如0和o，1和I之类的
      */
    $type = 'numeric'; 
    //生成字符串的验证码
    $code = $manager->create($namespace, $recipient, $expireIn, $length, $type);
    
    
    //在另一个地方，可以对验证码进行验证
    
    $isAvaiable = $manager->check($code, $namespace, $recipient);
    
    if($isAvaiable) {
        //验证码正确
    } else {
        //验证码不正确
    }
    


