<div class="<?=$this->cssClass;?>">
    <div class="name"><?=$this->row->firstname.' '.$this->row->lastname; ?></div>
    <div class="degree">
        <? if ($this->row->degree == 'e') { ?>
            <?= $this->data->trl('Ä'); ?>
        <? } else if ($this->row->degree == 'm') { ?>
            <?= $this->data->trl('DAG'); ?>
        <? } ?>
    </div>
    <div class="congregation"><?=$this->componentLink($this->congregation); ?></div>
    <div class="phone"><?=$this->data->trl('Tel:')?> <a href="tel:<?=$this->row->phone; ?>"><?=$this->row->phone; ?></a></div>
    <div class="email"><a href="mailto:<?=$this->row->email; ?>"><?=$this->row->email; ?></a></div>
    <div class="note"><?=$this->row->note;?></div>
    <div class="kwfSwitchDisplay">
        <a class="switchLink"><?=$this->data->trl('Zeige Vorträge');?></a>
        <div class="switchContent">
            <table class="talks">
                <? foreach ($this->talks as $talk) { ?>
                    <tr><td><?=$talk['number'];?></td><td><?=$talk['title'];?></td></tr>
                <? } ?>
            </table>
        </div>
    </div>
</div>
