<?$this->load->view('main_header')?>
<form method="post" action="<?=base_url()?>join/gender/">
    <div class="input_label">Пароль</div>
    <input type="password" name="user_password" value="<?=set_value('user_password')?>" /><?=form_error('user_password');?>
    <input type="submit" value="Далее" />
</form>
<?$this->load->view('main_footer')?>