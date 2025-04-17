<?php

namespace System\Core\Database\Statics;

use System\Core\Database\Interfaces\CollateInterface;

/**
 * Class Collate
 * @package System\Core\Database
 * @method static|self armscii8_bin()
 * @method static|self armscii8_general_ci()
 * @method static|self ascii_bin()
 * @method static|self ascii_general_ci()
 * @method static|self big5_bin()
 * @method static|self big5_chinese_ci()
 * @method static|self binary()
 * @method static|self cp1250_bin()
 * @method static|self cp1250_croatian_ci()
 * @method static|self cp1250_czech_cs()
 * @method static|self cp1250_general_ci()
 * @method static|self cp1250_polish_ci()
 * @method static|self cp1251_bin()
 * @method static|self cp1251_bulgarian_ci()
 * @method static|self cp1251_general_ci()
 * @method static|self cp1251_general_cs()
 * @method static|self cp1251_ukrainian_ci()
 * @method static|self cp1256_bin()
 * @method static|self cp1256_general_ci()
 * @method static|self cp1257_bin()
 * @method static|self cp1257_general_ci()
 * @method static|self cp1257_lithuanian_ci()
 * @method static|self cp850_bin()
 * @method static|self cp850_general_ci()
 * @method static|self cp852_bin()
 * @method static|self cp852_general_ci()
 * @method static|self cp866_bin()
 * @method static|self cp866_general_ci()
 * @method static|self cp932_bin()
 * @method static|self cp932_japanese_ci()
 * @method static|self dec8_bin()
 * @method static|self dec8_swedish_ci()
 * @method static|self eucjpms_bin()
 * @method static|self eucjpms_japanese_ci()
 * @method static|self euckr_bin()
 * @method static|self euckr_korean_ci()
 * @method static|self gb18030_bin()
 * @method static|self gb18030_chinese_ci()
 * @method static|self gb18030_unicode_520_ci()
 * @method static|self gb2312_bin()
 * @method static|self gb2312_chinese_ci()
 * @method static|self gbk_bin()
 * @method static|self gbk_chinese_ci()
 * @method static|self geostd8_bin()
 * @method static|self geostd8_general_ci()
 * @method static|self greek_bin()
 * @method static|self greek_general_ci()
 * @method static|self hebrew_bin()
 * @method static|self hebrew_general_ci()
 * @method static|self hp8_bin()
 * @method static|self hp8_english_ci()
 * @method static|self keybcs2_bin()
 * @method static|self keybcs2_general_ci()
 * @method static|self koi8r_bin()
 * @method static|self koi8r_general_ci()
 * @method static|self koi8u_bin()
 * @method static|self koi8u_general_ci()
 * @method static|self latin1_bin()
 * @method static|self latin1_danish_ci()
 * @method static|self latin1_general_ci()
 * @method static|self latin1_general_cs()
 * @method static|self latin1_german1_ci()
 * @method static|self latin1_german2_ci()
 * @method static|self latin1_spanish_ci()
 * @method static|self latin1_swedish_ci()
 * @method static|self latin2_bin()
 * @method static|self latin2_croatian_ci()
 * @method static|self latin2_czech_cs()
 * @method static|self latin2_general_ci()
 * @method static|self latin2_hungarian_ci()
 * @method static|self latin5_bin()
 * @method static|self latin5_turkish_ci()
 * @method static|self latin7_bin()
 * @method static|self latin7_estonian_cs()
 * @method static|self latin7_general_ci()
 * @method static|self latin7_general_cs()
 * @method static|self macce_bin()
 * @method static|self macce_general_ci()
 * @method static|self macroman_bin()
 * @method static|self macroman_general_ci()
 * @method static|self sjis_bin()
 * @method static|self sjis_japanese_ci()
 * @method static|self swe7_bin()
 * @method static|self swe7_swedish_ci()
 * @method static|self tis620_bin()
 * @method static|self tis620_thai_ci()
 * @method static|self ucs2_bin()
 * @method static|self ucs2_croatian_ci()
 * @method static|self ucs2_czech_ci()
 * @method static|self ucs2_danish_ci()
 * @method static|self ucs2_esperanto_ci()
 * @method static|self ucs2_estonian_ci()
 * @method static|self ucs2_general_ci()
 * @method static|self ucs2_general_mysql500_ci()
 * @method static|self ucs2_german2_ci()
 * @method static|self ucs2_hungarian_ci()
 * @method static|self ucs2_icelandic_ci()
 * @method static|self ucs2_latvian_ci()
 * @method static|self ucs2_lithuanian_ci()
 * @method static|self ucs2_persian_ci()
 * @method static|self ucs2_polish_ci()
 * @method static|self ucs2_roman_ci()
 * @method static|self ucs2_romanian_ci()
 * @method static|self ucs2_sinhala_ci()
 * @method static|self ucs2_slovak_ci()
 * @method static|self ucs2_slovenian_ci()
 * @method static|self ucs2_spanish2_ci()
 * @method static|self ucs2_spanish_ci()
 * @method static|self ucs2_swedish_ci()
 * @method static|self ucs2_turkish_ci()
 * @method static|self ucs2_unicode_520_ci()
 * @method static|self ucs2_unicode_ci()
 * @method static|self ucs2_vietnamese_ci()
 * @method static|self ujis_bin()
 * @method static|self ujis_japanese_ci()
 * @method static|self utf16_bin()
 * @method static|self utf16_croatian_ci()
 * @method static|self utf16_czech_ci()
 * @method static|self utf16_danish_ci()
 * @method static|self utf16_esperanto_ci()
 * @method static|self utf16_estonian_ci()
 * @method static|self utf16_general_ci()
 * @method static|self utf16_german2_ci()
 * @method static|self utf16_hungarian_ci()
 * @method static|self utf16_icelandic_ci()
 * @method static|self utf16_latvian_ci()
 * @method static|self utf16_lithuanian_ci()
 * @method static|self utf16_persian_ci()
 * @method static|self utf16_polish_ci()
 * @method static|self utf16_roman_ci()
 * @method static|self utf16_romanian_ci()
 * @method static|self utf16_sinhala_ci()
 * @method static|self utf16_slovak_ci()
 * @method static|self utf16_slovenian_ci()
 * @method static|self utf16_spanish2_ci()
 * @method static|self utf16_spanish_ci()
 * @method static|self utf16_swedish_ci()
 * @method static|self utf16_turkish_ci()
 * @method static|self utf16_unicode_520_ci()
 * @method static|self utf16_unicode_ci()
 * @method static|self utf16_vietnamese_ci()
 * @method static|self utf16le_bin()
 * @method static|self utf16le_general_ci()
 * @method static|self utf32_bin()
 * @method static|self utf32_croatian_ci()
 * @method static|self utf32_czech_ci()
 * @method static|self utf32_danish_ci()
 * @method static|self utf32_esperanto_ci()
 * @method static|self utf32_estonian_ci()
 * @method static|self utf32_general_ci()
 * @method static|self utf32_german2_ci()
 * @method static|self utf32_hungarian_ci()
 * @method static|self utf32_icelandic_ci()
 * @method static|self utf32_latvian_ci()
 * @method static|self utf32_lithuanian_ci()
 * @method static|self utf32_persian_ci()
 * @method static|self utf32_polish_ci()
 * @method static|self utf32_roman_ci()
 * @method static|self utf32_romanian_ci()
 * @method static|self utf32_sinhala_ci()
 * @method static|self utf32_slovak_ci()
 * @method static|self utf32_slovenian_ci()
 * @method static|self utf32_spanish2_ci()
 * @method static|self utf32_spanish_ci()
 * @method static|self utf32_swedish_ci()
 * @method static|self utf32_turkish_ci()
 * @method static|self utf32_unicode_520_ci()
 * @method static|self utf32_unicode_ci()
 * @method static|self utf32_vietnamese_ci()
 * @method static|self utf8mb3_bin()
 * @method static|self utf8mb3_croatian_ci()
 * @method static|self utf8mb3_czech_ci()
 * @method static|self utf8mb3_danish_ci()
 * @method static|self utf8mb3_esperanto_ci()
 * @method static|self utf8mb3_estonian_ci()
 * @method static|self utf8mb3_general_ci()
 * @method static|self utf8mb3_general_mysql500_ci()
 * @method static|self utf8mb3_german2_ci()
 * @method static|self utf8mb3_hungarian_ci()
 * @method static|self utf8mb3_icelandic_ci()
 * @method static|self utf8mb3_latvian_ci()
 * @method static|self utf8mb3_lithuanian_ci()
 * @method static|self utf8mb3_persian_ci()
 * @method static|self utf8mb3_polish_ci()
 * @method static|self utf8mb3_roman_ci()
 * @method static|self utf8mb3_romanian_ci()
 * @method static|self utf8mb3_sinhala_ci()
 * @method static|self utf8mb3_slovak_ci()
 * @method static|self utf8mb3_slovenian_ci()
 * @method static|self utf8mb3_spanish2_ci()
 * @method static|self utf8mb3_spanish_ci()
 * @method static|self utf8mb3_swedish_ci()
 * @method static|self utf8mb3_tolower_ci()
 * @method static|self utf8mb3_turkish_ci()
 * @method static|self utf8mb3_unicode_520_ci()
 * @method static|self utf8mb3_unicode_ci()
 * @method static|self utf8mb3_vietnamese_ci()
 * @method static|self utf8mb4_0900_ai_ci()
 * @method static|self utf8mb4_0900_as_ci()
 * @method static|self utf8mb4_0900_as_cs()
 * @method static|self utf8mb4_0900_bin()
 * @method static|self utf8mb4_bg_0900_ai_ci()
 * @method static|self utf8mb4_bg_0900_as_cs()
 * @method static|self utf8mb4_bin()
 * @method static|self utf8mb4_bs_0900_ai_ci()
 * @method static|self utf8mb4_bs_0900_as_cs()
 * @method static|self utf8mb4_croatian_ci()
 * @method static|self utf8mb4_cs_0900_ai_ci()
 * @method static|self utf8mb4_cs_0900_as_cs()
 * @method static|self utf8mb4_czech_ci()
 * @method static|self utf8mb4_da_0900_ai_ci()
 * @method static|self utf8mb4_da_0900_as_cs()
 * @method static|self utf8mb4_danish_ci()
 * @method static|self utf8mb4_de_pb_0900_ai_ci()
 * @method static|self utf8mb4_de_pb_0900_as_cs()
 * @method static|self utf8mb4_eo_0900_ai_ci()
 * @method static|self utf8mb4_eo_0900_as_cs()
 * @method static|self utf8mb4_es_0900_ai_ci()
 * @method static|self utf8mb4_es_0900_as_cs()
 * @method static|self utf8mb4_es_trad_0900_ai_ci()
 * @method static|self utf8mb4_es_trad_0900_as_cs()
 * @method static|self utf8mb4_esperanto_ci()
 * @method static|self utf8mb4_estonian_ci()
 * @method static|self utf8mb4_et_0900_ai_ci()
 * @method static|self utf8mb4_et_0900_as_cs()
 * @method static|self utf8mb4_general_ci()
 * @method static|self utf8mb4_german2_ci()
 * @method static|self utf8mb4_gl_0900_ai_ci()
 * @method static|self utf8mb4_gl_0900_as_cs()
 * @method static|self utf8mb4_hr_0900_ai_ci()
 * @method static|self utf8mb4_hr_0900_as_cs()
 * @method static|self utf8mb4_hu_0900_ai_ci()
 * @method static|self utf8mb4_hu_0900_as_cs()
 * @method static|self utf8mb4_hungarian_ci()
 * @method static|self utf8mb4_icelandic_ci()
 * @method static|self utf8mb4_is_0900_ai_ci()
 * @method static|self utf8mb4_is_0900_as_cs()
 * @method static|self utf8mb4_ja_0900_as_cs()
 * @method static|self utf8mb4_ja_0900_as_cs_ks()
 * @method static|self utf8mb4_la_0900_ai_ci()
 * @method static|self utf8mb4_la_0900_as_cs()
 * @method static|self utf8mb4_latvian_ci()
 * @method static|self utf8mb4_lithuanian_ci()
 * @method static|self utf8mb4_lt_0900_ai_ci()
 * @method static|self utf8mb4_lt_0900_as_cs()
 * @method static|self utf8mb4_lv_0900_ai_ci()
 * @method static|self utf8mb4_lv_0900_as_cs()
 * @method static|self utf8mb4_mn_cyrl_0900_ai_ci()
 * @method static|self utf8mb4_mn_cyrl_0900_as_cs()
 * @method static|self utf8mb4_nb_0900_ai_ci()
 * @method static|self utf8mb4_nb_0900_as_cs()
 * @method static|self utf8mb4_nn_0900_ai_ci()
 * @method static|self utf8mb4_nn_0900_as_cs()
 * @method static|self utf8mb4_persian_ci()
 * @method static|self utf8mb4_pl_0900_ai_ci()
 * @method static|self utf8mb4_pl_0900_as_cs()
 * @method static|self utf8mb4_polish_ci()
 * @method static|self utf8mb4_ro_0900_ai_ci()
 * @method static|self utf8mb4_ro_0900_as_cs()
 * @method static|self utf8mb4_roman_ci()
 * @method static|self utf8mb4_romanian_ci()
 * @method static|self utf8mb4_ru_0900_ai_ci()
 * @method static|self utf8mb4_ru_0900_as_cs()
 * @method static|self utf8mb4_sinhala_ci()
 * @method static|self utf8mb4_sk_0900_ai_ci()
 * @method static|self utf8mb4_sk_0900_as_cs()
 * @method static|self utf8mb4_sl_0900_ai_ci()
 * @method static|self utf8mb4_sl_0900_as_cs()
 * @method static|self utf8mb4_slovak_ci()
 * @method static|self utf8mb4_slovenian_ci()
 * @method static|self utf8mb4_spanish2_ci()
 * @method static|self utf8mb4_spanish_ci()
 * @method static|self utf8mb4_sr_latn_0900_ai_ci()
 * @method static|self utf8mb4_sr_latn_0900_as_cs()
 * @method static|self utf8mb4_sv_0900_ai_ci()
 * @method static|self utf8mb4_sv_0900_as_cs()
 * @method static|self utf8mb4_swedish_ci()
 * @method static|self utf8mb4_tr_0900_ai_ci()
 * @method static|self utf8mb4_tr_0900_as_cs()
 * @method static|self utf8mb4_turkish_ci()
 * @method static|self utf8mb4_unicode_520_ci()
 * @method static|self utf8mb4_unicode_ci()
 * @method static|self utf8mb4_vi_0900_ai_ci()
 * @method static|self utf8mb4_vi_0900_as_cs()
 * @method static|self utf8mb4_vietnamese_ci()
 * @method static|self utf8mb4_zh_0900_as_cs()
 */
class Collate implements CollateInterface
{
    protected const COLLATES = array(
        'armscii8_bin' => 'armscii8',
        'armscii8_general_ci' => 'armscii8',
        'ascii_bin' => 'ascii',
        'ascii_general_ci' => 'ascii',
        'big5_bin' => 'big5',
        'big5_chinese_ci' => 'big5',
        'binary' => 'binary',
        'cp1250_bin' => 'cp1250',
        'cp1250_croatian_ci' => 'cp1250',
        'cp1250_czech_cs' => 'cp1250',
        'cp1250_general_ci' => 'cp1250',
        'cp1250_polish_ci' => 'cp1250',
        'cp1251_bin' => 'cp1251',
        'cp1251_bulgarian_ci' => 'cp1251',
        'cp1251_general_ci' => 'cp1251',
        'cp1251_general_cs' => 'cp1251',
        'cp1251_ukrainian_ci' => 'cp1251',
        'cp1256_bin' => 'cp1256',
        'cp1256_general_ci' => 'cp1256',
        'cp1257_bin' => 'cp1257',
        'cp1257_general_ci' => 'cp1257',
        'cp1257_lithuanian_ci' => 'cp1257',
        'cp850_bin' => 'cp850',
        'cp850_general_ci' => 'cp850',
        'cp852_bin' => 'cp852',
        'cp852_general_ci' => 'cp852',
        'cp866_bin' => 'cp866',
        'cp866_general_ci' => 'cp866',
        'cp932_bin' => 'cp932',
        'cp932_japanese_ci' => 'cp932',
        'dec8_bin' => 'dec8',
        'dec8_swedish_ci' => 'dec8',
        'eucjpms_bin' => 'eucjpms',
        'eucjpms_japanese_ci' => 'eucjpms',
        'euckr_bin' => 'euckr',
        'euckr_korean_ci' => 'euckr',
        'gb18030_bin' => 'gb18030',
        'gb18030_chinese_ci' => 'gb18030',
        'gb18030_unicode_520_ci' => 'gb18030',
        'gb2312_bin' => 'gb2312',
        'gb2312_chinese_ci' => 'gb2312',
        'gbk_bin' => 'gbk',
        'gbk_chinese_ci' => 'gbk',
        'geostd8_bin' => 'geostd8',
        'geostd8_general_ci' => 'geostd8',
        'greek_bin' => 'greek',
        'greek_general_ci' => 'greek',
        'hebrew_bin' => 'hebrew',
        'hebrew_general_ci' => 'hebrew',
        'hp8_bin' => 'hp8',
        'hp8_english_ci' => 'hp8',
        'keybcs2_bin' => 'keybcs2',
        'keybcs2_general_ci' => 'keybcs2',
        'koi8r_bin' => 'koi8r',
        'koi8r_general_ci' => 'koi8r',
        'koi8u_bin' => 'koi8u',
        'koi8u_general_ci' => 'koi8u',
        'latin1_bin' => 'latin1',
        'latin1_danish_ci' => 'latin1',
        'latin1_general_ci' => 'latin1',
        'latin1_general_cs' => 'latin1',
        'latin1_german1_ci' => 'latin1',
        'latin1_german2_ci' => 'latin1',
        'latin1_spanish_ci' => 'latin1',
        'latin1_swedish_ci' => 'latin1',
        'latin2_bin' => 'latin2',
        'latin2_croatian_ci' => 'latin2',
        'latin2_czech_cs' => 'latin2',
        'latin2_general_ci' => 'latin2',
        'latin2_hungarian_ci' => 'latin2',
        'latin5_bin' => 'latin5',
        'latin5_turkish_ci' => 'latin5',
        'latin7_bin' => 'latin7',
        'latin7_estonian_cs' => 'latin7',
        'latin7_general_ci' => 'latin7',
        'latin7_general_cs' => 'latin7',
        'macce_bin' => 'macce',
        'macce_general_ci' => 'macce',
        'macroman_bin' => 'macroman',
        'macroman_general_ci' => 'macroman',
        'sjis_bin' => 'sjis',
        'sjis_japanese_ci' => 'sjis',
        'swe7_bin' => 'swe7',
        'swe7_swedish_ci' => 'swe7',
        'tis620_bin' => 'tis620',
        'tis620_thai_ci' => 'tis620',
        'ucs2_bin' => 'ucs2',
        'ucs2_croatian_ci' => 'ucs2',
        'ucs2_czech_ci' => 'ucs2',
        'ucs2_danish_ci' => 'ucs2',
        'ucs2_esperanto_ci' => 'ucs2',
        'ucs2_estonian_ci' => 'ucs2',
        'ucs2_general_ci' => 'ucs2',
        'ucs2_general_mysql500_ci' => 'ucs2',
        'ucs2_german2_ci' => 'ucs2',
        'ucs2_hungarian_ci' => 'ucs2',
        'ucs2_icelandic_ci' => 'ucs2',
        'ucs2_latvian_ci' => 'ucs2',
        'ucs2_lithuanian_ci' => 'ucs2',
        'ucs2_persian_ci' => 'ucs2',
        'ucs2_polish_ci' => 'ucs2',
        'ucs2_roman_ci' => 'ucs2',
        'ucs2_romanian_ci' => 'ucs2',
        'ucs2_sinhala_ci' => 'ucs2',
        'ucs2_slovak_ci' => 'ucs2',
        'ucs2_slovenian_ci' => 'ucs2',
        'ucs2_spanish2_ci' => 'ucs2',
        'ucs2_spanish_ci' => 'ucs2',
        'ucs2_swedish_ci' => 'ucs2',
        'ucs2_turkish_ci' => 'ucs2',
        'ucs2_unicode_520_ci' => 'ucs2',
        'ucs2_unicode_ci' => 'ucs2',
        'ucs2_vietnamese_ci' => 'ucs2',
        'ujis_bin' => 'ujis',
        'ujis_japanese_ci' => 'ujis',
        'utf16_bin' => 'utf16',
        'utf16_croatian_ci' => 'utf16',
        'utf16_czech_ci' => 'utf16',
        'utf16_danish_ci' => 'utf16',
        'utf16_esperanto_ci' => 'utf16',
        'utf16_estonian_ci' => 'utf16',
        'utf16_general_ci' => 'utf16',
        'utf16_german2_ci' => 'utf16',
        'utf16_hungarian_ci' => 'utf16',
        'utf16_icelandic_ci' => 'utf16',
        'utf16_latvian_ci' => 'utf16',
        'utf16_lithuanian_ci' => 'utf16',
        'utf16_persian_ci' => 'utf16',
        'utf16_polish_ci' => 'utf16',
        'utf16_roman_ci' => 'utf16',
        'utf16_romanian_ci' => 'utf16',
        'utf16_sinhala_ci' => 'utf16',
        'utf16_slovak_ci' => 'utf16',
        'utf16_slovenian_ci' => 'utf16',
        'utf16_spanish2_ci' => 'utf16',
        'utf16_spanish_ci' => 'utf16',
        'utf16_swedish_ci' => 'utf16',
        'utf16_turkish_ci' => 'utf16',
        'utf16_unicode_520_ci' => 'utf16',
        'utf16_unicode_ci' => 'utf16',
        'utf16_vietnamese_ci' => 'utf16',
        'utf16le_bin' => 'utf16le',
        'utf16le_general_ci' => 'utf16le',
        'utf32_bin' => 'utf32',
        'utf32_croatian_ci' => 'utf32',
        'utf32_czech_ci' => 'utf32',
        'utf32_danish_ci' => 'utf32',
        'utf32_esperanto_ci' => 'utf32',
        'utf32_estonian_ci' => 'utf32',
        'utf32_general_ci' => 'utf32',
        'utf32_german2_ci' => 'utf32',
        'utf32_hungarian_ci' => 'utf32',
        'utf32_icelandic_ci' => 'utf32',
        'utf32_latvian_ci' => 'utf32',
        'utf32_lithuanian_ci' => 'utf32',
        'utf32_persian_ci' => 'utf32',
        'utf32_polish_ci' => 'utf32',
        'utf32_roman_ci' => 'utf32',
        'utf32_romanian_ci' => 'utf32',
        'utf32_sinhala_ci' => 'utf32',
        'utf32_slovak_ci' => 'utf32',
        'utf32_slovenian_ci' => 'utf32',
        'utf32_spanish2_ci' => 'utf32',
        'utf32_spanish_ci' => 'utf32',
        'utf32_swedish_ci' => 'utf32',
        'utf32_turkish_ci' => 'utf32',
        'utf32_unicode_520_ci' => 'utf32',
        'utf32_unicode_ci' => 'utf32',
        'utf32_vietnamese_ci' => 'utf32',
        'utf8mb3_bin' => 'utf8mb3',
        'utf8mb3_croatian_ci' => 'utf8mb3',
        'utf8mb3_czech_ci' => 'utf8mb3',
        'utf8mb3_danish_ci' => 'utf8mb3',
        'utf8mb3_esperanto_ci' => 'utf8mb3',
        'utf8mb3_estonian_ci' => 'utf8mb3',
        'utf8mb3_general_ci' => 'utf8mb3',
        'utf8mb3_general_mysql500_ci' => 'utf8mb3',
        'utf8mb3_german2_ci' => 'utf8mb3',
        'utf8mb3_hungarian_ci' => 'utf8mb3',
        'utf8mb3_icelandic_ci' => 'utf8mb3',
        'utf8mb3_latvian_ci' => 'utf8mb3',
        'utf8mb3_lithuanian_ci' => 'utf8mb3',
        'utf8mb3_persian_ci' => 'utf8mb3',
        'utf8mb3_polish_ci' => 'utf8mb3',
        'utf8mb3_roman_ci' => 'utf8mb3',
        'utf8mb3_romanian_ci' => 'utf8mb3',
        'utf8mb3_sinhala_ci' => 'utf8mb3',
        'utf8mb3_slovak_ci' => 'utf8mb3',
        'utf8mb3_slovenian_ci' => 'utf8mb3',
        'utf8mb3_spanish2_ci' => 'utf8mb3',
        'utf8mb3_spanish_ci' => 'utf8mb3',
        'utf8mb3_swedish_ci' => 'utf8mb3',
        'utf8mb3_tolower_ci' => 'utf8mb3',
        'utf8mb3_turkish_ci' => 'utf8mb3',
        'utf8mb3_unicode_520_ci' => 'utf8mb3',
        'utf8mb3_unicode_ci' => 'utf8mb3',
        'utf8mb3_vietnamese_ci' => 'utf8mb3',
        'utf8mb4_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_0900_as_ci' => 'utf8mb4',
        'utf8mb4_0900_as_cs' => 'utf8mb4',
        'utf8mb4_0900_bin' => 'utf8mb4',
        'utf8mb4_bg_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_bg_0900_as_cs' => 'utf8mb4',
        'utf8mb4_bin' => 'utf8mb4',
        'utf8mb4_bs_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_bs_0900_as_cs' => 'utf8mb4',
        'utf8mb4_croatian_ci' => 'utf8mb4',
        'utf8mb4_cs_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_cs_0900_as_cs' => 'utf8mb4',
        'utf8mb4_czech_ci' => 'utf8mb4',
        'utf8mb4_da_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_da_0900_as_cs' => 'utf8mb4',
        'utf8mb4_danish_ci' => 'utf8mb4',
        'utf8mb4_de_pb_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_de_pb_0900_as_cs' => 'utf8mb4',
        'utf8mb4_eo_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_eo_0900_as_cs' => 'utf8mb4',
        'utf8mb4_es_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_es_0900_as_cs' => 'utf8mb4',
        'utf8mb4_es_trad_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_es_trad_0900_as_cs' => 'utf8mb4',
        'utf8mb4_esperanto_ci' => 'utf8mb4',
        'utf8mb4_estonian_ci' => 'utf8mb4',
        'utf8mb4_et_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_et_0900_as_cs' => 'utf8mb4',
        'utf8mb4_general_ci' => 'utf8mb4',
        'utf8mb4_german2_ci' => 'utf8mb4',
        'utf8mb4_gl_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_gl_0900_as_cs' => 'utf8mb4',
        'utf8mb4_hr_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_hr_0900_as_cs' => 'utf8mb4',
        'utf8mb4_hu_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_hu_0900_as_cs' => 'utf8mb4',
        'utf8mb4_hungarian_ci' => 'utf8mb4',
        'utf8mb4_icelandic_ci' => 'utf8mb4',
        'utf8mb4_is_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_is_0900_as_cs' => 'utf8mb4',
        'utf8mb4_ja_0900_as_cs' => 'utf8mb4',
        'utf8mb4_ja_0900_as_cs_ks' => 'utf8mb4',
        'utf8mb4_la_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_la_0900_as_cs' => 'utf8mb4',
        'utf8mb4_latvian_ci' => 'utf8mb4',
        'utf8mb4_lithuanian_ci' => 'utf8mb4',
        'utf8mb4_lt_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_lt_0900_as_cs' => 'utf8mb4',
        'utf8mb4_lv_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_lv_0900_as_cs' => 'utf8mb4',
        'utf8mb4_mn_cyrl_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_mn_cyrl_0900_as_cs' => 'utf8mb4',
        'utf8mb4_nb_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_nb_0900_as_cs' => 'utf8mb4',
        'utf8mb4_nn_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_nn_0900_as_cs' => 'utf8mb4',
        'utf8mb4_persian_ci' => 'utf8mb4',
        'utf8mb4_pl_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_pl_0900_as_cs' => 'utf8mb4',
        'utf8mb4_polish_ci' => 'utf8mb4',
        'utf8mb4_ro_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_ro_0900_as_cs' => 'utf8mb4',
        'utf8mb4_roman_ci' => 'utf8mb4',
        'utf8mb4_romanian_ci' => 'utf8mb4',
        'utf8mb4_ru_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_ru_0900_as_cs' => 'utf8mb4',
        'utf8mb4_sinhala_ci' => 'utf8mb4',
        'utf8mb4_sk_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_sk_0900_as_cs' => 'utf8mb4',
        'utf8mb4_sl_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_sl_0900_as_cs' => 'utf8mb4',
        'utf8mb4_slovak_ci' => 'utf8mb4',
        'utf8mb4_slovenian_ci' => 'utf8mb4',
        'utf8mb4_spanish2_ci' => 'utf8mb4',
        'utf8mb4_spanish_ci' => 'utf8mb4',
        'utf8mb4_sr_latn_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_sr_latn_0900_as_cs' => 'utf8mb4',
        'utf8mb4_sv_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_sv_0900_as_cs' => 'utf8mb4',
        'utf8mb4_swedish_ci' => 'utf8mb4',
        'utf8mb4_tr_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_tr_0900_as_cs' => 'utf8mb4',
        'utf8mb4_turkish_ci' => 'utf8mb4',
        'utf8mb4_unicode_520_ci' => 'utf8mb4',
        'utf8mb4_unicode_ci' => 'utf8mb4',
        'utf8mb4_vi_0900_ai_ci' => 'utf8mb4',
        'utf8mb4_vi_0900_as_cs' => 'utf8mb4',
        'utf8mb4_vietnamese_ci' => 'utf8mb4',
        'utf8mb4_zh_0900_as_cs' => 'utf8mb4'
    );

    protected $charset;
    protected $collate;

    public static function __callStatic($name, $arguments)
    {
        $charset = '';
        if(isset($arguments[0])){
            $charset = $arguments[0];
        }else
            if(isset(self::COLLATES[$name])){
                $charset = self::COLLATES[$name];
            }

        return new self($charset, $name);
    }

    public function __construct($charset, $collate)
    {
        $this->charset = $charset;
        $this->collate = $collate;
    }

    public function getCharset()
    {
        return $this->charset;
    }

    public function getCollate()
    {
        return $this->collate;
    }
}