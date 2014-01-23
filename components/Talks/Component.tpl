<div class="<?=$this->cssClass?>">
    <h1><?=$this->data->trl('Vortragsthemen');?></h1>
    <table class="talks">
        <? foreach ($this->talks as $talk) { ?>
            <tr class="talk">
                <td><?=$talk->number;?></td><td><?=$talk->title;?></td>
            </tr>
        <? } ?>
        <tr><td>
    </table>
</div>