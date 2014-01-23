<div class="<?=$this->cssClass?>">
    <?=$this->component($this->form)?>
    <? if ($this->lostPassword) { ?>
        <p><?=$this->data->trlKwf("If you have lost your password,")?>
        <?=$this->componentLink($this->lostPassword, $this->data->trlKwf('request a new one here'))?>.
        </p>
    <? } ?>
</div>
