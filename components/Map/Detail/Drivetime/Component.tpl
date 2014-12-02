<div class="<?=$this->cssClass?>">
    <? if ($this->travelTime) { ?>
        <div class="travelTime"><?=$this->travelTime;?></div>
    <? } else { ?>
        <div class="calculateTime" data-congregation-id="<?=$this->congregationId?>"><?=$this->data->trl('Berechne Zeit');?></div>
    <? } ?>
</div>
