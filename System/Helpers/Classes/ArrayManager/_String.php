<?php

namespace System\Helpers\Classes\ArrayManager;
/**
 * Class Strings
 * @package System\Helpers\Classes\ArrayManager
 * @method json_decode($assoc = false, $depth = 512, $options = 0)
 * @method htmlspecialchars($flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, $encoding = null, $double_encode = true)
 * @method trim($characters = " \n\r\t\v\x00")
 * @method ltrim($characters = " \n\r\t\v\x00")
 * @method rtrim($characters = " \n\r\t\v\x00")
 * @method addcslashes($characters)
 * @method addslashes()
 * @method chunk_split($length = 76, $separator = "\r\n")
 * @method convert_uudecode()
 * @method convert_uuencode()
 * @method count_chars($mode = 0)
 * @method crc32()
 * @method explode($separator, $limit = PHP_INT_MAX)
 * @method hebrev($max_chars_per_line = 0)
 * @method hex2bin()
 * @method html_entity_decode($flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, $encoding = null)
 * @method htmlentities($flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, $encoding = null, $double_encode = true)
 * @method htmlspecialchars_decode($flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401)
 * @method lcfirst()
 * @method ucfirst()
 * @method ucwords($separators = " \t\r\n\f\v")
 * @method levenshtein($string2, $insertion_cost = 1, $replacement_cost = 1, $deletion_cost = 1)
 * @method md5($binary = false)
 * @method metaphone($max_phonemes = 0)
 * @method nl2br($use_xhtml = true)
 * @method number_format($decimals = 0, $decimal_separator = ".", $thousands_separator = ",")
 * @method parse_str(&$result)
 * @method quotemeta()
 * @method sha1($binary = false)
 * @method similar_text($string2, &$percent = null)
 * @method soundex()
 * @method str_contains($needle)
 * @method str_decrement()
 * @method str_ends_with($needle)
 * @method str_getcsv($separator = ",", $enclosure = "\"", $escape = "\\")
 * @method str_increment()
 * @method str_pad($length, $pad_string = " ", $pad_type = STR_PAD_RIGHT)
 * @method str_repeat($times)
 * @method str_rot13()
 * @method str_shuffle()
 * @method str_split($length = 1)
 * @method str_starts_with($needle)
 * @method str_word_count($format = 0, $characters = null)
 * @method strcasecmp($string2)
 * @method strstr($needle, $before_needle = false)
 * @method strchr($needle, $before_needle = false)
 * @method strcmp($string2)
 * @method strcoll($string2)
 * @method strcspn($characters, $offset = 0, $length = null)
 * @method strip_tags($allowed_tags = null)
 * @method stripcslashes()
 * @method stripos($needle, $offset = 0)
 * @method strpos($needle, $offset = 0)
 * @method strripos($needle, $offset = 0)
 * @method strrpos($needle, $offset = 0)
 * @method stripslashes()
 * @method stristr($needle, $before_needle = false)
 * @method strlen()
 * @method strnatcasecmp($string2)
 * @method strnatcmp($string2)
 * @method strncasecmp($string2, $length)
 * @method strncmp($string2, $length)
 * @method strpbrk($characters)
 * @method strrchr($needle, $before_needle = false)
 * @method strrev()
 * @method strspn($characters, $offset = 0, $length = null)
 * @method strtok($token)
 * @method strtolower()
 * @method strtoupper()
 * @method strtr($from, $to)
 * @method substr($offset, $length = null)
 * @method substr_compare($needle, $offset, $length = null, $case_insensitive = false)
 * @method substr_count($needle, $offset, $length = null)
 * @method substr_replace($replace, $offset, $length = null)
 * @method wordwrap($width = 75, $break = "\n", $cut_long_words = false)
 * @method preg_quote($delimiter = null)
 * @method mb_check_encoding($encoding = null)
 * @method mb_chr($encoding = null)
 * @method mb_convert_case($mode, $encoding = null)
 * @method mb_convert_encoding($to_encoding, $from_encoding = null)
 * @method mb_convert_kana(string $mode = "KV", $encoding = null)
 * @method mb_decode_mimeheader()
 * @method mb_decode_numericentity($map, $encoding = null)
 * @method mb_detect_encoding($encodings = null, $strict = false)
 * @method mb_encode_mimeheader($charset = null, $transfer_encoding = null, $newline = "\r\n", $indent = 0)
 * @method mb_encode_numericentity($map, $encoding = null, $hex = false)
 * @method mb_lcfirst($encoding = null)
 * @method mb_ltrim($characters = null, $encoding = null)
 * @method mb_ord($encoding = null)
 * @method mb_parse_str(&$result)
 * @method mb_rtrim($characters = null, $encoding = null)
 * @method mb_scrub($encoding = null)
 * @method mb_str_pad($length, $pad_string = " ", $pad_type = STR_PAD_RIGHT, $encoding = null)
 * @method mb_str_split($length = 1, $encoding = null)
 * @method mb_strcut($start, $length = null, $encoding = null)
 * @method mb_strimwidth($start, $width, $trim_marker = "", $encoding = null)
 * @method mb_stripos($needle, $offset = 0, $encoding = null)
 * @method mb_strpos($needle, $offset = 0, $encoding = null)
 * @method mb_strripos($needle, $offset = 0, $encoding = null)
 * @method mb_strrpos($needle, $offset = 0, $encoding = null)
 * @method mb_stristr($needle, $before_needle = false, $encoding = null)
 * @method mb_strrchr($needle, $before_needle = false, $encoding = null)
 * @method mb_strrichr($needle, $before_needle = false, $encoding = null)
 * @method mb_strstr($needle, $before_needle = false, $encoding = null)
 * @method mb_substr_count($needle, $encoding = null)
 * @method mb_strlen($encoding = null)
 * @method mb_strtolower($encoding = null)
 * @method mb_strtoupper($encoding = null)
 * @method mb_strwidth($encoding = null)
 * @method mb_substr($start, $length = null, $encoding = null)
 * @method mb_trim($characters = null, $encoding = null)
 * @method mb_ucfirst($encoding = null)
 */
class _String
{
    protected $subject;

    public function __call($name, $arguments)
    {
        if(function_exists($name)){
            return call_user_func($name, $this->subject, ...$arguments);
        }
        return null;
    }

    public function __construct($subject)
    {
        $this->subject = is_string($subject) ? $subject : '';
    }

    public function raw()
    {
        return $this->subject;
    }

    public function str_ireplace($search, $replace, &$count = null)
    {
        return str_ireplace($search, $replace, $this->subject, $count);
    }

    public function str_replace($search, $replace, &$count = null)
    {
        return str_replace($search, $replace, $this->subject, $count);
    }

    public function preg_filter($pattern, $replacement, $limit = -1, &$count = null)
    {
        return preg_filter($pattern, $replacement, $this->subject, $limit, $count);
    }

    public function preg_replace($pattern, $replacement, $limit = -1, &$count = null)
    {
        return preg_replace($pattern, $replacement, $this->subject, $limit, $count);
    }

    public function preg_replace_callback($pattern, $callback, $limit = -1, &$count = null, $flags = 0)
    {
        return preg_replace_callback($pattern, $callback, $this->subject, $limit, $count, $flags);
    }

    public function preg_replace_callback_array($pattern, $limit = -1, &$count = null)
    {
        return preg_replace_callback_array($pattern, $this->subject, $limit, $count);
    }

    public function preg_match($pattern, &$matches = null, $flags = 0, $offset = 0)
    {
        return preg_match($pattern, $this->subject, $matches, $flags, $offset);
    }

    public function preg_match_all($pattern, &$matches = null, $flags = 0, $offset = 0)
    {
        return preg_match_all($pattern, $this->subject, $matches, $flags, $offset);
    }

    public function preg_split($pattern, $limit = -1, $flags = 0)
    {
        return preg_split($pattern, $this->subject, $limit, $flags);
    }

    public function mb_convert_variables($to_encoding, $from_encoding)
    {
        return mb_convert_variables($to_encoding, $from_encoding, $this->subject);
    }

    public function mb_ereg($pattern, &$matches = null)
    {
        return mb_ereg($pattern, $this->subject, $matches);
    }

    public function mb_ereg_match($pattern, $options = null)
    {
        return mb_ereg_match($pattern, $this->subject, $options);
    }

    public function mb_ereg_replace($pattern, $replacement, $options = null)
    {
        return mb_ereg_replace($pattern, $replacement, $this->subject, $options);
    }

    public function mb_ereg_replace_callback($pattern, callable $callback, $options = null)
    {
        return mb_ereg_replace_callback($pattern, $callback, $this->subject, $options);
    }

    public function mb_eregi($pattern, array &$matches = null)
    {
        return mb_eregi($pattern, $this->subject, $matches);
    }

    public function mb_eregi_replace($pattern, $replacement, $options = null)
    {
        return mb_eregi_replace($pattern, $replacement, $this->subject, $options);
    }

    public function mb_split($pattern, $limit = -1)
    {
        return mb_split($pattern, $this->subject, $limit);
    }

    public function replace_k2v(array $replace)
    {
        return $this->str_replace(array_keys($replace), array_values($replace), $this->subject);
    }

    public function ireplace_k2v(array $replace)
    {
        return $this->str_ireplace(array_keys($replace), array_values($replace), $this->subject);
    }
}