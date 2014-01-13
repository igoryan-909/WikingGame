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
    
    public function get_user_resource($resource, $where)
    {
        $CI = &get_instance();
        $amount = $CI->crud->get(GAME_USERS_PARAMETERS_TABLE, $where);
        return $amount[0]['user_parameter_' . $resource];
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
    
    public function user_crusade_start($time_start, $time_end, $time_length)
    {
        $CI = &get_instance();
        $where = array
                    (
                    'game_crusade_user_id'   => $CI->session->userdata('user_id')
                    );
        $user_data = $CI->crud->get(GAME_CRUSADE_TABLE, $where);
        $data = array
                    (
                    'game_crusade_time_start'       => $time_start,
                    'game_crusade_time_end'         => $time_end,
                    'game_crusade_set_limit_date'   => date('Y-m-d'),
                    'game_crusade_send_resources'   => '0',
                    'game_crusade_in_crusade'       => '1'
                    );
        if(!empty($user_data))
        {
            if($user_data[0]['game_crusade_current_date_total_time'] > $time_length && !$user_data[0]['game_crusade_in_crusade'])
            {
                $data['game_crusade_current_date_total_time'] = $user_data[0]['game_crusade_current_date_total_time'] - $time_length;
                if($CI->crud->edit(GAME_CRUSADE_TABLE, $data, $where)) return TRUE;
                else return FALSE;
            } else return FALSE;
        } else
        {
            $data['game_crusade_current_date_total_time'] = 100 - $time_length;
            if($CI->crud->add(GAME_CRUSADE_TABLE, $data + $where) != FALSE) return TRUE;
            else return FALSE;
            //print_r($data + $where);
        }
    }
    
    public function get_user_crusade_data()
    {
        $CI = &get_instance();
        $where = array
                    (
                    'game_crusade_user_id'   => $CI->session->userdata('user_id')
                    );
        $user_data = $CI->crud->get(GAME_CRUSADE_TABLE, $where);
        $in_crusade = FALSE;
        $elapsed_time = FALSE;
        $time_available = 100;
        $game_crusade_set_limit_date = 100;
        $game_crusade_send_resources = 1;
        if(!empty($user_data))
        {
            $in_crusade = $user_data[0]['game_crusade_in_crusade'];
            if(time() < $user_data[0]['game_crusade_time_end'] && $in_crusade)
            {
                $elapsed_time = date('i : s', $user_data[0]['game_crusade_time_end'] - time());
            }
            $time_available = $user_data[0]['game_crusade_current_date_total_time'];
            $game_crusade_set_limit_date = $user_data[0]['game_crusade_set_limit_date'];
            $game_crusade_send_resources = $user_data[0]['game_crusade_send_resources'];
        }
        return array
                    (
                    'in_crusade'                    => $in_crusade,
                    'elapsed_time'                  => $elapsed_time,
                    'time_available'                => $time_available,
                    'game_crusade_set_limit_date'   => $game_crusade_set_limit_date,
                    'game_crusade_send_resources'   => $game_crusade_send_resources
                    );
    }
    
    public function crusade_resources()
    {
        $CI = &get_instance();
        $crusade_data = $this->get_user_crusade_data();
        if($crusade_data['game_crusade_send_resources'] == 0 && !$crusade_data['elapsed_time'])
        {
            $where_parameters = array
                    (
                    'user_parameter_user_id' => $CI->session->userdata('user_id')
                    );
            $where_crusade = array
                    (
                    'game_crusade_user_id'   => $CI->session->userdata('user_id')
                    );
            $resource = $this->generate_resources();
            $current_amount = $this->get_user_resource($resource['resource'], $where_parameters);
            $this->set_user_resource($resource['resource'], $current_amount + $resource['amount'], $where_parameters);
            $data = array
                        (
                        'game_crusade_send_resources'   => '1',
                        'game_crusade_in_crusade'       => '0'
                        );
            $CI->crud->edit(GAME_CRUSADE_TABLE, $data, $where_crusade);
        }
    }
    
    public function check_crusade_limit()
    {
        $CI = &get_instance();
        $crusade_data = $this->get_user_crusade_data();
        if($crusade_data['game_crusade_set_limit_date'] != date('Y-m-d'))
        {
            $where_crusade = array
                    (
                    'game_crusade_user_id'   => $CI->session->userdata('user_id')
                    );
            $data = array
                    (
                    'game_crusade_current_date_total_time' => 100,
                    'game_crusade_set_limit_date'          => date('Y-m-d')
                    );
            $CI->crud->edit(GAME_CRUSADE_TABLE, $data, $where_crusade);
        }
    }
    
    private function generate_resources()
    {
        $resource = (rand(1, 100) < 80) ? 'silver' : 'gold';
        if($resource == 'gold') $amount = 1;
        if($resource == 'silver') $amount = rand(50, 100);
        return array
                (
                'resource'   => $resource,
                'amount'     => $amount
                );
    }
    
    private function check_resources($user_data, $resource, $amount)
    {
        if($user_data[0]['user_parameter_' . $resource] < $amount) return FALSE;
        else return TRUE;
    }
}