<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8" />
	<title><?=$title?></title>
</head>
<body>
<div id="container" style="margin: 0 auto;max-width: 700px;">
    <?if($this->lib_auth->check_user($this->session->userdata('user_id'))):?>
    <div><a href="<?=base_url()?>"><?=$this->lang->line('main_page')?></a> | <a href="<?=base_url()?>user/"><?=user_menu('user_name')?></a> | <?=$this->lib_declension->regex_num(1, 'silver')?>:  <?=user_menu('user_parameter_silver')?> | <?=$this->lib_declension->regex_num(1, 'gold')?>: <?=user_menu('user_parameter_gold')?> | <a href="<?=base_url()?>logout/"><?=$this->lang->line('exit')?></a></div>
    <?endif?>