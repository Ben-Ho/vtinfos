<div class="<?=$this->rootElementClass?>">
    <?=$this->component($this->form)?>
    <div class="problemSolvingRegion">
        <?=$this->data->trl('Wenn du dein Passwort vergessen hast,')?>
        <?=$this->componentLink($this->lostPassword, $this->data->trl('kannst du hier ein neues anfordern.'))?><br/>
        <?=$this->data->trl('Bei Login-Problemen bitte an +43/699 12 63 41 50 wenden.');?>
    </div>
</div>
