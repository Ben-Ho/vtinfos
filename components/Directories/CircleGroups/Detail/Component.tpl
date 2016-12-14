<div class="<?=$this->rootElementClass?>">
    <h2><?=$this->row->name;?></h2>
    <a class="downloadPdf" href="<?=$this->pdfDownloadUrl;?>" target="_blank">
        <img src="/assets/silkicons/page_white_acrobat.png" width="16" height="16">
    </a>
    <?=$this->component($this->circles);?>
</div>
