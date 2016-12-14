<div class="<?=$this->rootElementClass?>">
    <?php  if ($this->travelTime) { ?>
        <div class="travelTime"><?=$this->travelTime;?></div>
    <?php  } else { ?>
        <div class="calculateTime"
            data-congregation-id="<?=$this->congregationId?>"
            data-component-id="<?=$this->componentId;?>">
            <?=$this->data->trl('Berechne Zeit');?>
        </div>
    <?php  } ?>
</div>
