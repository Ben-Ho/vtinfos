<div class="<?=$this->rootElementClass?>">
    <input type="text" class="talkSearch">
    <table class="talks">
        <?php  foreach ($this->talks as $talk) { ?>
            <tr class="talk">
                <td><?=$talk->number;?></td>
                <td class="clickable"><?=$talk->getTitle($this->language);?>
                    <ul class="category">
                        <?php foreach ($talk->getChildRows('TalksToCategories') as $talkToCategory) { ?>
                            <li>
                                <?= $talkToCategory->getParentRow('Category')->getCategoryTitle($this->language); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </td>
            </tr>
        <?php } ?>
        <tr><td>
    </table>
</div>
