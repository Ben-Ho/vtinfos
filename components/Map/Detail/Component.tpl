<div class="<?=$this->cssClass?>">
    <?=$this->component($this->drivetime);?>
    <div class="popupTitle"><?=$this->data->trl('Versammlungen');?></div>
    <div class="congregations">
        <? foreach ($this->congregations as $congregation) { ?>
            <div class="congregation">
                <?=$this->componentLink($congregation);?>
            </div>
        <? } ?>
    </div>
</div>
