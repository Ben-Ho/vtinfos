<div class="<?=$this->cssClass?>">
    <? if ($this->travelTime) { ?>
        <div class="travelTime"><?=$this->travelTime;?></div>
    <? } else { ?>
        <div class="calculateTime"
            data-congregation-id="<?=$this->congregationId?>"
            data-component-id="<?=$this->componentId;?>">
            <?=$this->data->trl('Berechne Zeit');?>
        </div>
    <? } ?>
</div>
