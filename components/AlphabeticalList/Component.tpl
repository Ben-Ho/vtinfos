<div class="<?=$this->cssClass?>">
    <h1><?=$this->data->trl('Versammlungen A-Z');?></h1>
    <div class="congregations">
    <? $prevLetter = null; ?>
        <? foreach ($this->congregations as $congregation) { ?>
            <? if ($prevLetter != substr($congregation->getRow()->name, 0, 1)) { ?>
                <? $prevLetter = substr($congregation->getRow()->name, 0, 1); ?>
                <div class="letter"><?=$prevLetter;?></div>
            <? } ?>
            <div class="congregation">
                <?=$this->componentLink($congregation);?>
            </div>
        <? } ?>
    </div>
</div>