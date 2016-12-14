<div class="<?=$this->rootElementClass?>">
    <?=$this->component($this->drivetime);?>
    <div class="popupTitle"><?=$this->data->trl('Versammlungen');?></div>
    <div class="congregations">
        <?php  foreach ($this->congregations as $congregation) { ?>
            <div class="congregation">
                <?=$this->componentLink($congregation);?>
            </div>
        <?php  } ?>
    </div>
</div>
