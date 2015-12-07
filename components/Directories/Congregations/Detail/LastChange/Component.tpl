<div class="<?=$this->cssClass?>">
    <?=$this->data->trl('Letzte Änderung:');?>
    <span class="date">
        <? if ($this->lastChange == 0) { ?>
            <?=$this->data->trl('keine Änderung');?>
        <? } else { ?>
            <?=$this->date($this->lastChange);?>
        <? } ?>
    </span>
</div>
