<h1><?=$this->lang->line('user_registration')?></h1>
<form method="post" action="<?=base_url()?>join/password/">
    <div class="input_label">Имя</div>
    <input type="text" name="user_name" value="<?=set_value('user_name')?>" />
    <input type="submit" value="Далее" />
	<?=form_error('user_name');?>
</form>
<div>Уже зарегистрированы в игре? <a href="<?=base_url()?>authorize">Вход в игру</a></div>