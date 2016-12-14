<div class="<?=$this->rootElementClass?>">
    <?=$this->data->trl('Letzte Änderung:');?>
    <span class="date">
        <?php  if ($this->lastChange == 0) { ?>
            <?=$this->data->trl('keine Änderung');?>
        <?php  } else { ?>
            <?=$this->date($this->lastChange);?>
        <?php  } ?>
    </span>
</div>
