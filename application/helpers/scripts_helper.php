<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('css_advanced'))
{
    function css_advanced($css)
    {
        if(is_array($css))
        {
            $css_list = '';
            foreach($css as $table)
            {
                $css_list .= 
'<link rel="stylesheet" href="'.base_url().'css/'.$table.'.css" type="text/css" media="screen" />
';
            }
        } else
        {
            $css_list = '<link rel="stylesheet" href="'.base_url().'css/'.$css.'.css" type="text/css" media="screen" />
';
        }
        return $css_list;
    }
}

if( ! function_exists('scripts'))
{
    function scripts($scripts)
    {
        if(is_array($scripts))
        {
            $scripts_list = '';
            foreach($scripts as $script)
            {
                $scripts_list .= 
'<script type="text/javascript" src="'.base_url().'js/'.$script.'.js"></script>
';
            }
        } else
        {
            $scripts_list = '<script type="text/javascript" src="'.base_url().'js/'.$scripts.'.js"></script>
';
        }
        return $scripts_list;
    }
}

if( ! function_exists('jquery_load'))
{
    function jquery_load()
    {
        $jquery = '<script type="text/javascript" src="'.base_url().'js/jquery-1.7.2.min.js"></script>
';
        return $jquery;
    }
}