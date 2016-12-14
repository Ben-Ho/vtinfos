<div class="<?=$this->rootElementClass?>">
    <?php  if ($this->addressPdfUrl) { ?>
        <div class="addressPdfUrl">
            <span></span>
            <a href="<?=$this->addressPdfUrl;?>"><?=$this->data->trl('Versammlungs-Adressen-Pdf herunterladen');?></a>
        </div>
    <?php  } ?>
    <?php  if ($this->csvExportUrl) { ?>
        <div class="csvExportUrl">
            <span></span>
            <a href="<?=$this->csvExportUrl;?>"><?=$this->data->trl('Redner.csv herunterladen');?></a>
        </div>
    <?php  } ?>
</div>
