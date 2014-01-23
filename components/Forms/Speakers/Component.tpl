<div class="<?=$this->cssClass?>">
    <h1><?=$this->data->trl('Meine Redner');?></h1>
    <h2><?=$this->data->trl('Redner bearbeiten');?></h2>
    <div class="speakers">
        <? foreach ($this->speakers as $speaker) { ?>
            <?=$this->component($speaker); ?>
        <? } ?>
    </div>
    <h2><?=$this->data->trl('Neuen Redner anlegen');?></h2>
    <div class="new-speaker">
        <?=$this->component($this->new); ?>
    </div>
</div>