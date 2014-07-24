<li class="<?=$this->cssClass;?>">
    <div class="name"><?=$this->row->firstname.' '.$this->row->lastname; ?></div>
    <div class="degree">
        <? if ($this->row->degree == 'eldest') { ?>
            <?= $this->data->trl('Ä'); ?>
        <? } else if ($this->row->degree == 'ministry_assistent') { ?>
            <?= $this->data->trl('DAG'); ?>
        <? } ?>
    </div>
    <div class="congregation"><?=$this->row->getParentRow('Congregation')->name; ?></div>
    <div class="phone"><?=$this->data->trl('Tel:')?> <a href="tel:<?=$this->row->phone; ?>"><?=$this->row->phone; ?></a></div>
    <div class="email"><a href="mailto:<?=$this->row->email; ?>"><?=$this->row->email; ?></a></div>
    <div class="kwfSwitchDisplay">
        <a class="switchLink"><?=$this->data->trl('Zeige Vorträge');?></a>
        <div class="switchContent">
            <table class="talks">
                <? $select = new Kwf_Model_Select(); ?>
                <? $select->order('number');?>
                <? foreach ($this->row->getChildRows('SpeakerToTalks', $select) as $talk) { ?>
                    <tr><td><?=$talk->number;?></td><td><?=$talk->title;?></td></tr>
                <? } ?>
            </table>
        </div>
    </div>
</li>
