<h1><?=$this->lang->line('user_registration')?></h1>
<form method="post" action="<?=base_url()?>join/gender/">
    <div class="input_label">Пароль</div>
    <input type="password" name="user_password" value="<?=set_value('user_password')?>" />
    <input type="submit" value="Далее" />
	<?=form_error('user_password');?>
</form>