<div class="<?=$this->cssClass?>">
    <h3><?=$this->row->name;?></h3>
    <a class="downloadPdf" href="<?=$this->pdfDownloadUrl;?>" target="_blank">
        <img src="/assets/web/images/downloadPdf.png" width="30" height="30">
    </a>
    <?=$this->component($this->congregations);?>
</div>
