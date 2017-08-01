<div class="<?=$this->rootElementClass?>">
    <input type="text" class="talkSearch">
    <table class="talks">
        <?php  foreach ($this->talks as $talk) { ?>
            <tr class="talk">
                <td><?=$talk->number;?></td><td><?=$talk->getTitle($this->language);?></td>
            </tr>
        <?php  } ?>
        <tr><td>
    </table>
</div>
