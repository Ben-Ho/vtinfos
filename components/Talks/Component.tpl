<div class="<?=$this->cssClass?>">
    <table class="talks">
        <? foreach ($this->talks as $talk) { ?>
            <tr class="talk">
                <td><?=$talk->number;?></td><td><?=$talk->getTitle($this->language);?></td>
            </tr>
        <? } ?>
        <tr><td>
    </table>
</div>
