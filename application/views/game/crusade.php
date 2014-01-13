<h1><?=$this->lang->line('crusade')?></h1>
<p><?=$this->lang->line('available_crusade_day')?>: <?=$time_available?> <?=$this->lib_declension->regex_num($time_available, 'minutes', TRUE)?></p>
<?if($elapsed_time):?>
<p><?=$this->lang->line('elapsed')?>: <?=$elapsed_time?> <a href="<?=base_url()?>crusade/"><?=$this->lang->line('refresh')?></a></p>
<?endif?>
<?if(!$elapsed_time && $time_available >= 10):?>
<form method="post" action="<?=base_url()?>crusade/go/">
    <select name="crusade_time">
        <option value="10">10 <?=$this->lib_declension->regex_num(10, 'minutes', TRUE)?></option>
        <option value="20">20 <?=$this->lib_declension->regex_num(20, 'minutes', TRUE)?></option>
    </select>
    <input type="submit" value="<?=$this->lang->line('crusade')?>" />
</form>
<?endif?>