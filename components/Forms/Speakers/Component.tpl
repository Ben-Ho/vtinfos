<div class="<?=$this->rootElementClass?>">
    <h1><?=$this->data->trl('Meine Redner');?></h1>
    <h2><?=$this->data->trl('Redner bearbeiten');?></h2>
    <div class="speakers">
        <?php  foreach ($this->speakers as $speaker) { ?>
            <?=$this->component($speaker); ?>
        <?php  } ?>
    </div>
    <h2><?=$this->data->trl('Neuen Redner anlegen');?></h2>
    <div class="new-speaker">
        <?=$this->component($this->new); ?>
    </div>
</div>