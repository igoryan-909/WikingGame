<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lib_view
{
    public function output($views, $data = FALSE)
    {
        $CI = &get_instance();
        if(is_array($views))
        {
            foreach($views as $key => $view)
            {
                ($key == 0 && $data) ? $CI->load->view($view, $data) : $CI->load->view($view);
            }
        } else
        {
            ($data) ? $CI->load->view($view, $data) : $CI->load->view($view);
        }
    }
}