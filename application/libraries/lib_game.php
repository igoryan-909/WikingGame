<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lib_game
{
    
    
    public function set_user_resource($resource, $amount, $where)
    {
        $CI = &get_instance();
        $new_resource = array
                        (
                        'user_parameter_' . $resource => $amount
                        );
        $CI->crud->edit(GAME_USERS_PARAMETERS_TABLE, $new_resource, $where);
    }
    
    public function set_user_level($property)
    {
        $CI = &get_instance();
        switch($property)
        {
            case 'strong' : 
                $percent = 25;
                break;
            case 'armor' : 
                $percent = 19;
                break;
            case 'intuition' : 
                $percent = 27;
                break;
            case 'agility' : 
                $percent = 17;
                break;
            case 'endurance' : 
                $percent = 20;
                break;
        }
        $where_parameters = array
                    (
                    'user_parameter_user_id' => $CI->session->userdata('user_id')
                    );
        $user_data = $CI->crud->get(GAME_USERS_PARAMETERS_TABLE, $where_parameters);
        
        $where_enhancements = array
                    (
                    'users_enhancement_user_id' => $CI->session->userdata('user_id')
                    );
        $data_enhancements = $CI->crud->get(GAME_USERS_ENHANCEMENTS_TABLE, $where_enhancements);
        
        $new_data_parameters = array
                    (
                    'user_parameter_' . $property   => $user_data[0]['user_parameter_' . $property] + 1,
                    );
                    if($data_enhancements[0]['users_enhancement_' . $property] < 400)
                    {
                        $new_upgrade_amount = $data_enhancements[0]['users_enhancement_' . $property] * 2;
                    } else
                    {
                        $new_upgrade_amount = round($data_enhancements[0]['users_enhancement_' . $property] + ($data_enhancements[0]['users_enhancement_' . $property] * $percent / 100), 0);
                    }
        $new_data_enhancements = array
                    (
                    'users_enhancement_' . $property   => $new_upgrade_amount,
                    );
        if($this->check_resources($user_data, 'silver', $data_enhancements[0]['users_enhancement_' . $property]))
        {
            $this->set_user_resource('silver', $user_data[0]['user_parameter_silver'] - $data_enhancements[0]['users_enhancement_' . $property], $where_parameters);
            $CI->crud->edit(GAME_USERS_PARAMETERS_TABLE, $new_data_parameters, $where_parameters);
            $CI->crud->edit(GAME_USERS_ENHANCEMENTS_TABLE, $new_data_enhancements, $where_enhancements);
            return TRUE;
        } else return FALSE;
    }
    
    public function user_crusade_start($time)
    {
        
    }
    
    private function check_resources($user_data, $resource, $amount)
    {
        if($user_data[0]['user_parameter_' . $resource] < $amount) return FALSE;
        else return TRUE;
    }
}
