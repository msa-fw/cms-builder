<?php

namespace System\Helpers\Classes;

/**
 * Class Hash
 * @package System\Helpers\Classes
 * @method static md2($data, $rawOutput = false, array $options = array())
 * @method static md4($data, $rawOutput = false, array $options = array())
 * @method static md5($data, $rawOutput = false, array $options = array())
 * @method static sha1($data, $rawOutput = false, array $options = array())
 * @method static sha224($data, $rawOutput = false, array $options = array())
 * @method static sha256($data, $rawOutput = false, array $options = array())
 * @method static sha384($data, $rawOutput = false, array $options = array())
 * @method static sha512_224($data, $rawOutput = false, array $options = array())
 * @method static sha512_256($data, $rawOutput = false, array $options = array())
 * @method static sha512($data, $rawOutput = false, array $options = array())
 * @method static sha3_224($data, $rawOutput = false, array $options = array())
 * @method static sha3_256($data, $rawOutput = false, array $options = array())
 * @method static sha3_384($data, $rawOutput = false, array $options = array())
 * @method static sha3_512($data, $rawOutput = false, array $options = array())
 * @method static ripemd128($data, $rawOutput = false, array $options = array())
 * @method static ripemd160($data, $rawOutput = false, array $options = array())
 * @method static ripemd256($data, $rawOutput = false, array $options = array())
 * @method static ripemd320($data, $rawOutput = false, array $options = array())
 * @method static whirlpool($data, $rawOutput = false, array $options = array())
 * @method static tiger128_3($data, $rawOutput = false, array $options = array())
 * @method static tiger160_3($data, $rawOutput = false, array $options = array())
 * @method static tiger192_3($data, $rawOutput = false, array $options = array())
 * @method static tiger128_4($data, $rawOutput = false, array $options = array())
 * @method static tiger160_4($data, $rawOutput = false, array $options = array())
 * @method static tiger192_4($data, $rawOutput = false, array $options = array())
 * @method static snefru($data, $rawOutput = false, array $options = array())
 * @method static snefru256($data, $rawOutput = false, array $options = array())
 * @method static gost($data, $rawOutput = false, array $options = array())
 * @method static gost_crypto($data, $rawOutput = false, array $options = array())
 * @method static adler32($data, $rawOutput = false, array $options = array())
 * @method static crc32($data, $rawOutput = false, array $options = array())
 * @method static crc32b($data, $rawOutput = false, array $options = array())
 * @method static crc32c($data, $rawOutput = false, array $options = array())
 * @method static fnv132($data, $rawOutput = false, array $options = array())
 * @method static fnv1a32($data, $rawOutput = false, array $options = array())
 * @method static fnv164($data, $rawOutput = false, array $options = array())
 * @method static fnv1a64($data, $rawOutput = false, array $options = array())
 * @method static joaat($data, $rawOutput = false, array $options = array())
 * @method static haval128_3($data, $rawOutput = false, array $options = array())
 * @method static haval160_3($data, $rawOutput = false, array $options = array())
 * @method static haval192_3($data, $rawOutput = false, array $options = array())
 * @method static haval224_3($data, $rawOutput = false, array $options = array())
 * @method static haval256_3($data, $rawOutput = false, array $options = array())
 * @method static haval128_4($data, $rawOutput = false, array $options = array())
 * @method static haval160_4($data, $rawOutput = false, array $options = array())
 * @method static haval192_4($data, $rawOutput = false, array $options = array())
 * @method static haval224_4($data, $rawOutput = false, array $options = array())
 * @method static haval256_4($data, $rawOutput = false, array $options = array())
 * @method static haval128_5($data, $rawOutput = false, array $options = array())
 * @method static haval160_5($data, $rawOutput = false, array $options = array())
 * @method static haval192_5($data, $rawOutput = false, array $options = array())
 * @method static haval224_5($data, $rawOutput = false, array $options = array())
 * @method static haval256_5($data, $rawOutput = false, array $options = array())
 * @method static murmur3a($data, $rawOutput = false, array $options = array())
 * @method static murmur3c($data, $rawOutput = false, array $options = array())
 * @method static murmur3f($data, $rawOutput = false, array $options = array())
 * @method static xxh32($data, $rawOutput = false, array $options = array())
 * @method static xxh64($data, $rawOutput = false, array $options = array())
 * @method static xxh3($data, $rawOutput = false, array $options = array())
 * @method static xxh128($data, $rawOutput = false, array $options = array())
 */
class Hash
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
        'adler32' => 'adler32',
        'crc32' => 'crc32',
        'crc32b' => 'crc32b',
        'crc32c' => 'crc32c',
        'fnv132' => 'fnv132',
        'fnv1a32' => 'fnv1a32',
        'fnv164' => 'fnv164',
        'fnv1a64' => 'fnv1a64',
        'joaat' => 'joaat',
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
        'murmur3a' => 'murmur3a',
        'murmur3c' => 'murmur3c',
        'murmur3f' => 'murmur3f',
        'xxh32' => 'xxh32',
        'xxh64' => 'xxh64',
        'xxh3' => 'xxh3',
        'xxh128' => 'xxh128',
    );

    public static function __callStatic($name, $arguments)
    {
        if($arguments){
            $name = mb_strtolower($name);
            if(isset(self::$algorithms[$name])){
                return hash(self::$algorithms[$name], ...$arguments);
            }
        }
        return false;
    }
}