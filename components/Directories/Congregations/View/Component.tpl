<div class="<?=$this->rootElementClass?>">
    <input class="filter" type="text" placeholder="<?=$this->data->trl('Suchfeld');?>" />
    <ul>
    <?=$this->partials($this->data);?>
    </ul>
</div>
