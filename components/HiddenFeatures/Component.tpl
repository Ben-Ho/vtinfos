<div class="<?=$this->cssClass?>">
    <? if ($this->addressPdfUrl) { ?>
        <div class="addressPdfUrl">
            <span></span>
            <a href="<?=$this->addressPdfUrl;?>"><?=$this->data->trl('Versammlungs-Adressen-Pdf herunterladen');?></a>
        </div>
    <? } ?>
</div>
