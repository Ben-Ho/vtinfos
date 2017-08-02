<div class="<?=$this->rootElementClass?>">
    <input type="text" class="talkSearch">
    <table class="talks">
        <?php  foreach ($this->talks as $talk) { ?>
            <tr class="talk">
                <td><?=$talk->number;?></td>
                <td class="clickable"><?=$talk->getTitle($this->language);?>
                    <div class="category">
                        <?php  foreach ($this->talksToCategories as $talkToCategory) {
                            if($talk->number == $talkToCategory->talk_id) {
                                $index = $talkToCategory->category_id - 1;
                                echo $this->talkCategories[$index]->getCategoryTitle($this->language)  . " " ;
                            }
                        }?>
                    </div></td>
            </tr>
        <?php  } ?>
        <tr><td>
    </table>
</div>
