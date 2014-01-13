<?php
/**
 * @автор Ivanoff
 * @описание файла: 
 * @изменен 24.1.2011
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lib_declension {
    //Функция для правильного склонения слова в зависимости от цифр
    function regex_num($num, $parameter, $reg = FALSE) {
        $CI = &get_instance();
        if(preg_match('/^[1]{1}$|^[0-9]*(0{1}|[2-9]{1})[1]{1}$/', $num))
        {
            $lang_set = $CI->lang->line($parameter);
            return (!$reg) ? $lang_set[0] : $lang_set[3];
        }
        if(preg_match('/^[5-9]{1}$|^[0-9]*[0]{1}$|^[0-9]*[1]{1}[0-9]{1}$|^[0-9]*(0{1}|[2-9]{1})[5-9]{1}$/', $num))
        {
            $lang_set = $CI->lang->line($parameter);
            return (!$reg) ? $lang_set[1] : $lang_set[4];
        }
        if(preg_match('/^[2-4]{1}$|^[0-9]*(0{1}|[2-9]{1})[2-4]{1}$/', $num))
        {
            $lang_set = $CI->lang->line($parameter);
            return (!$reg) ? $lang_set[2] : $lang_set[5];
        }
    }
}
?>
