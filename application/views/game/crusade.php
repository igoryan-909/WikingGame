<?$this->load->view('main_header')?>
<h1><?=$this->lang->line('crusade')?></h1>
<?if(!$elapsed_time):?>
<p>Available: <?=$time_available?> minutes</p>
<?endif?>
<?if($elapsed_time):?>
<p>Elapsed: <?=$elapsed_time?> <a href="<?=base_url()?>crusade">Refresh</a></p>
<?endif?>
<?if(!$elapsed_time):?>
<form method="post" action="<?=base_url()?>crusade/go/">
    <select name="crusade_time">
        <option value="1">10 minutes</option>
        <option value="20">20 minutes</option>
    </select>
    <input type="submit" value="<?=$this->lang->line('crusade')?>" />
</form>
<?endif?>
<?$this->load->view('main_footer')?>