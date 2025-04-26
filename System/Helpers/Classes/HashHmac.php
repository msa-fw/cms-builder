<?php

namespace System\Helpers\Classes;

/**
 * Class Hash
 * @package System\Helpers\Classes
 * @method static md2($data, $key, $rawOutput = false)
 * @method static md4($data, $key, $rawOutput = false)
 * @method static md5($data, $key, $rawOutput = false)
 * @method static sha1($data, $key, $rawOutput = false)
 * @method static sha224($data, $key, $rawOutput = false)
 * @method static sha256($data, $key, $rawOutput = false)
 * @method static sha384($data, $key, $rawOutput = false)
 * @method static sha512_224($data, $key, $rawOutput = false)
 * @method static sha512_256($data, $key, $rawOutput = false)
 * @method static sha512($data, $key, $rawOutput = false)
 * @method static sha3_224($data, $key, $rawOutput = false)
 * @method static sha3_256($data, $key, $rawOutput = false)
 * @method static sha3_384($data, $key, $rawOutput = false)
 * @method static sha3_512($data, $key, $rawOutput = false)
 * @method static ripemd128($data, $key, $rawOutput = false)
 * @method static ripemd160($data, $key, $rawOutput = false)
 * @method static ripemd256($data, $key, $rawOutput = false)
 * @method static ripemd320($data, $key, $rawOutput = false)
 * @method static whirlpool($data, $key, $rawOutput = false)
 * @method static tiger128_3($data, $key, $rawOutput = false)
 * @method static tiger160_3($data, $key, $rawOutput = false)
 * @method static tiger192_3($data, $key, $rawOutput = false)
 * @method static tiger128_4($data, $key, $rawOutput = false)
 * @method static tiger160_4($data, $key, $rawOutput = false)
 * @method static tiger192_4($data, $key, $rawOutput = false)
 * @method static snefru($data, $key, $rawOutput = false)
 * @method static snefru256($data, $key, $rawOutput = false)
 * @method static gost($data, $key, $rawOutput = false)
 * @method static gost_crypto($data, $key, $rawOutput = false)
 * @method static haval128_3($data, $key, $rawOutput = false)
 * @method static haval160_3($data, $key, $rawOutput = false)
 * @method static haval192_3($data, $key, $rawOutput = false)
 * @method static haval224_3($data, $key, $rawOutput = false)
 * @method static haval256_3($data, $key, $rawOutput = false)
 * @method static haval128_4($data, $key, $rawOutput = false)
 * @method static haval160_4($data, $key, $rawOutput = false)
 * @method static haval192_4($data, $key, $rawOutput = false)
 * @method static haval224_4($data, $key, $rawOutput = false)
 * @method static haval256_4($data, $key, $rawOutput = false)
 * @method static haval128_5($data, $key, $rawOutput = false)
 * @method static haval160_5($data, $key, $rawOutput = false)
 * @method static haval192_5($data, $key, $rawOutput = false)
 * @method static haval224_5($data, $key, $rawOutput = false)
 * @method static haval256_5($data, $key, $rawOutput = false)
 */
class HashHmac
{
    protected static $algorithms = array(
        'md2' => 'md2',
        'md4' => 'md4',
        'md5' => 'md5',
        'sha1' => 'sha1',
        'sha224' => 'sha224',
        'sha256' => 'sha256',
        'sha384' => 'sha384',
        'sha512_224' => 'sha512/224',
        'sha512_256' => 'sha512/256',
        'sha512' => 'sha512',
        'sha3_224' => 'sha3-224',
        'sha3_256' => 'sha3-256',
        'sha3_384' => 'sha3-384',
        'sha3_512' => 'sha3-512',
        'ripemd128' => 'ripemd128',
        'ripemd160' => 'ripemd160',
        'ripemd256' => 'ripemd256',
        'ripemd320' => 'ripemd320',
        'whirlpool' => 'whirlpool',
        'tiger128_3' => 'tiger128,3',
        'tiger160_3' => 'tiger160,3',
        'tiger192_3' => 'tiger192,3',
        'tiger128_4' => 'tiger128,4',
        'tiger160_4' => 'tiger160,4',
        'tiger192_4' => 'tiger192,4',
        'snefru' => 'snefru',
        'snefru256' => 'snefru256',
        'gost' => 'gost',
        'gost_crypto' => 'gost-crypto',
        'haval128_3' => 'haval128,3',
        'haval160_3' => 'haval160,3',
        'haval192_3' => 'haval192,3',
        'haval224_3' => 'haval224,3',
        'haval256_3' => 'haval256,3',
        'haval128_4' => 'haval128,4',
        'haval160_4' => 'haval160,4',
        'haval192_4' => 'haval192,4',
        'haval224_4' => 'haval224,4',
        'haval256_4' => 'haval256,4',
        'haval128_5' => 'haval128,5',
        'haval160_5' => 'haval160,5',
        'haval192_5' => 'haval192,5',
        'haval224_5' => 'haval224,5',
        'haval256_5' => 'haval256,5',
    );

    public static function __callStatic($name, $arguments)
    {
        if($arguments){
            $name = mb_strtolower($name);
            if(isset(self::$algorithms[$name])){
                return hash_hmac(self::$algorithms[$name], ...$arguments);
            }
        }
        return false;
    }
}