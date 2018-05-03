<div class="<?=$this->cssClass?>">
    <input type="hidden" class="config" value="<?=htmlspecialchars(json_encode($this->config))?>">
    <div class="popupWrapper">
        <?=$this->component($this->form)?>
        <button class="later"><?=$this->data->trl('Später akzeptieren');?></button>
    </div>
</div>
