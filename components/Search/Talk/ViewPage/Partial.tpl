<li class="speaker">
    <div class="name"><?=$this->item->getRow()->firstname.' '.$this->item->getRow()->lastname; ?></div>
    <div class="degree">
        <? if ($this->item->getRow()->degree == 'eldest') { ?>
            <?= $this->data->trl('Ältester'); ?>
        <? } else if ($this->item->getRow()->degree == 'ministry_assistent') { ?>
            <?= $this->data->trl('DAG'); ?>
        <? } ?>
    </div>
    <div class="congregation"><?=$this->item->getRow()->getParentRow('Congregation')->name; ?></div>
    <div class="phone"><?=$this->data->trl('Tel:')?> <a href="tel:<?=$this->item->getRow()->phone; ?>"><?=$this->item->getRow()->phone; ?></a></div>
    <div class="email"><a href="mailto:<?=$this->item->getRow()->email; ?>"><?=$this->item->getRow()->email; ?></a></div>
    <div class="kwfSwitchDisplay">
        <a class="switchLink"><?=$this->data->trl('Zeige Vorträge');?></a>
        <table class="talks switchContent">
            <? $select = new Kwf_Model_Select(); ?>
            <? $select->order('number');?>
            <? foreach ($this->item->getRow()->getChildRows('SpeakerToTalks', $select) as $talk) { ?>
                <tr><td><?=$talk->number;?></td><td><?=$talk->title;?></td></tr>
            <? } ?>
        </table>
    </div>
    <hr />
</li>
