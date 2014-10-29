<div class="<?=$this->cssClass?>">
    <div class="travelTime">1h 30min</div>
    <div class="congregations">
        <? foreach ($this->congregations as $congregation) { ?>
            <div class="congregation">
                <?=$this->componentLink($congregation);?>
            </div>
        <? } ?>
    </div>
</div>
