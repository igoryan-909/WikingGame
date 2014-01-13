<?$this->load->view('main_header')?>
<h1><?=$this->lang->line('enhancement')?></h1>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('strong')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_strong?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_strong?> <?=$this->lang->line('silver')?></p>
    <p><a href="<?=base_url()?>user/enhancement/strong/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('armor')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_armor?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_armor?> <?=$this->lang->line('silver')?></p>
    <p><a href="<?=base_url()?>user/enhancement/armor/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('intuition')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_intuition?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_intuition?> <?=$this->lang->line('silver')?></p>
    <p><a href="<?=base_url()?>user/enhancement/intuition/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('agility')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_agility?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_agility?> <?=$this->lang->line('silver')?></p>
    <p><a href="<?=base_url()?>user/enhancement/agility/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<div style="border-bottom: 1px solid black;">
    <h3><?=$this->lang->line('endurance')?></h3>
    <p><?=$this->lang->line('user_level')?>: <?=$user_parameter_endurance?></p>
    <p><?=$this->lang->line('enhancement_price')?>: <?=$users_enhancement_endurance?> <?=$this->lang->line('silver')?></p>
    <p><a href="<?=base_url()?>user/enhancement/endurance/"><?=$this->lang->line('upgrade')?></a></p>
</div>
<?$this->load->view('main_footer')?>