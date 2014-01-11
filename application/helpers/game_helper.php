<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('user_menu'))
{
    function user_menu($parameter)
    {
        $CI = &get_instance();
        $where_user = array('user_id' => $CI->session->userdata('user_id'));
        $where_parameter = array('user_parameter_user_id' => $CI->session->userdata('user_id'));
        $user = $CI->crud->get(USERS_TABLE, $where_user);
        $user_parameters = $CI->crud->get(GAME_USERS_PARAMETERS_TABLE, $where_parameter);
        switch($parameter)
        {
            case 'user_name' :
                return $user[0][$parameter];
                break;
            case 'user_parameter_silver' :
                return $user_parameters[0][$parameter];
                break;
            case 'user_parameter_gold' :
                return $user_parameters[0][$parameter];
                break;
        }
    }
}