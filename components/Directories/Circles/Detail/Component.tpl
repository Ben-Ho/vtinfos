<div class="<?=$this->rootElementClass?>">
    <h3><?=$this->row->name;?></h3>
    <a class="downloadPdf" href="<?=$this->pdfDownloadUrl;?>" target="_blank">
        <img src="/assets/silkicons/page_white_acrobat.png" width="16" height="16">
    </a>
    <?=$this->component($this->congregations);?>
</div>
