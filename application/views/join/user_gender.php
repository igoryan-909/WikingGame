<?$this->load->view('main_header')?>
<form method="post" action="<?=base_url()?>join/send/">
    <div class="input_label">Пол</div>
    <select name="user_gender">
        <option value="0" <?=set_select('user_gender', '0')?>>Мужской</option>
        <option value="1" <?=set_select('user_gender', '1')?>>Женский</option>
    </select>
    <input type="submit" value="Далее" />
</form>
<?$this->load->view('main_footer')?>