<h1><?=$this->lang->line('authorize')?></h1>
<form method="post" action="<?=base_url()?>authorize/send/">
    <div class="input_label"><?=$this->lang->line('user_name')?></div>
    <input type="text" name="user_name" />
    <div class="input_label"><?=$this->lang->line('user_password')?></div>
    <input type="password" name="user_password" />
    <input type="submit" value="<?=$this->lang->line('login')?>" />
</form>
<?=isset($error) ? $error : ''?>