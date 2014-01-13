<h1><?=$this->lang->line('enhancement')?></h1>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('strong')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_strong?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_strong?> <?=$this->lib_declension->regex_num($users_enhancement_strong, 'silver', TRUE)?></p>
    <p><a href="<?=base_url()?>user/enhancement/strong/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('armor')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_armor?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_armor?> <?=$this->lib_declension->regex_num($users_enhancement_armor, 'silver', TRUE)?></p>
    <p><a href="<?=base_url()?>user/enhancement/armor/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('intuition')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_intuition?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_intuition?> <?=$this->lib_declension->regex_num($users_enhancement_intuition, 'silver', TRUE)?></p>
    <p><a href="<?=base_url()?>user/enhancement/intuition/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('agility')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_agility?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_agility?> <?=$this->lib_declension->regex_num($users_enhancement_agility, 'silver', TRUE)?></p>
    <p><a href="<?=base_url()?>user/enhancement/agility/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('endurance')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_endurance?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_endurance?> <?=$this->lib_declension->regex_num($users_enhancement_endurance, 'silver', TRUE)?></p>
    <p><a href="<?=base_url()?>user/enhancement/endurance/"><?=$this->lang->line('upgrade')?></a></p>
</div>