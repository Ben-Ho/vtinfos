<div class="<?=$this->cssClass?>">
    <? foreach ($this->congregations as $congregation) { ?>
        <div class="congregation">
            <?=$this->componentLink($congregation);?>
        </div>
    <? } ?>
</div>