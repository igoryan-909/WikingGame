<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<title><?=$title?></title>
</head>
<body>
<div id="container" style="margin: 0 auto;max-width: 700px;">
    <?if($this->lib_auth->check_user($this->session->userdata('user_id'))):?>
    <div><a href="<?=base_url()?>"><?=$this->lang->line('main_page')?></a> | <a href="<?=base_url()?>user/"><?=user_menu('user_name')?></a> | Silver :  <?=user_menu('user_parameter_silver')?> | Gold: <?=user_menu('user_parameter_gold')?> | <a href="<?=base_url()?>logout/">Logout</a></div>
    <?endif?>