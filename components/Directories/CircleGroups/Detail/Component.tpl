<div class="<?=$this->rootElementClass?>">
    <h2><?=$this->row->name;?></h2>
    <a class="downloadPdf" href="<?=$this->pdfDownloadUrl;?>" target="_blank">
        <img src="/assets/silkicons/page_white_acrobat.png" width="16" height="16">
    </a>
    <?php if ($this->row->additional_link) { ?>
        <a class="additionalLink" href="<?=$this->row->additional_link?>"><?=$this->data->trl('Andere Versammlungen')?></a>
    <?php } ?>
    <?=$this->component($this->circles);?>
</div>
