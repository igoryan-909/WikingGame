<?php
/**
 * @автор Ivanoff
 * @описание файла: 
 * @изменен 27.12.2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    function __construct() {
        parent::__construct();
        $CI = &get_instance();
        $CI->lang->load('validation_new');
    }
    
    function az_numeric($str) {
        return ( ! preg_match("/^([a-z0-9])+$/i", $str)) ? FALSE : TRUE;
    }  
	
    /**
    * Валидация url
    */ 
    function valid_url ($str) {
        if($str == trim('http://')) return true;
        return (!preg_match('/^(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:;.?+=&%@!\-\/]))?$/',$str)) ? FALSE : TRUE;
    }
    
	/**
	 * Валидное название
	 */ 
    function valid_title ($str)
    {
     return (!preg_match ('/^[А-Яа-яЁё\w\d\s\.\,\+\-\_\!\?\#\%\@\№\/\(\)\[\]\:\&\$\*]{1,250}$/'
                    ,$str)) ? FALSE : TRUE;
    }       
	
	/**
	 * Проверка на уникальность
	 */
    function uniq_mail ($str, $param) {
        //Объект CI
        $CI = & get_instance ();
        //Имя таблицы
        $tname = str_replace ($param,'board_users',$param);
        
        $CI->db->where($param,$str);
        return ($CI->db->count_all_results($tname)==0);
    }
    
    public function uniq_user_name ($user_name) {
        $CI = & get_instance ();
        $CI->db->where('user_name', $user_name);
        return ($CI->db->count_all_results(USERS_TABLE) == 0);
    }
    
    function uniq_nick ($str, $param) {
        //Объект CI
        $CI = & get_instance ();
        //Имя таблицы
        $tname = str_replace ($param,'board_users',$param);
        
        $CI->db->where($param,$str);
        return ($CI->db->count_all_results($tname)==0);
    }
    
    function alpha_numeric_rus($str)
	{
		return (!preg_match("/^([АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюяA-Za-z0-9 ])+$/i", $str)) ? FALSE : TRUE;
	}
    
    function board_title($str) {
        return (!preg_match("/^([АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюяA-Za-z0-9-_:;.,\(\)!?\"'\/ ])+$/i", $str)) ? FALSE : TRUE;
    }
    
    function positive_int($str) {
        return ($str >= 0) ? TRUE : FALSE;
    }
    
    function valid_db_district($str, $param) {
        $CI = & get_instance ();
        $tname = str_replace ($param,'districts',$param);
        
        $CI->db->where($param,$str);
        return ($CI->db->count_all_results($tname)!= 0);
    }
    
    function valid_db_rubric($str, $param) {
        $CI = & get_instance ();
        $tname = str_replace ($param,'board_rubrics',$param);
        
        $CI->db->where($param,$str);
        return ($CI->db->count_all_results($tname)!= 0);
    }
    
    function no_tags($str) {
        return htmlspecialchars($str);
    }
    
    function coord($str) {
        if ( ! is_array($str))
		{
			return (trim($str) == 'not') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
    }
}
?>