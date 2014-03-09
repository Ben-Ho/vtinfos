<div class="<?=$this->cssClass?>">
    <h1><?=$this->row->name;?></h1>
    <div class="congregation-info">
        <div class="time">
            <div class="talk-time"><span class="label"><?=$this->data->trl('Vortragszeit:');?></span> <?=$this->row->talk_time;?></div>
            <div class="ministryschool-time"><span class="label"><?=$this->data->trl('Predigtdienstschule:');?></span> <?=$this->row->ministryschool_time;?></div>
        </div>
        <div class="address">
            <div class="street"><?=$this->row->street;?></div>
            <div class="zip"><?=$this->row->zip;?></div>
            <div class="city"><?=$this->row->city;?></div>
            <div class="country"><?=$this->row->country;?></div>
        </div>
    </div>
    <div class="coordinator">
        <h2><?=$this->data->trl('Koordinator');?></h2>
        <? if ($this->coordinator) { ?>
            <div class="name"><?=$this->coordinator->firstname.' '.$this->coordinator->lastname;?></div>
            <div class="degree">
                <? if ($this->coordinator->degree == 'eldest') { ?>
                    <?= $this->data->trl('Ältester'); ?>
                <? } else if ($this->coordinator->degree == 'ministry_assistent') { ?>
                    <?= $this->data->trl('DAG'); ?>
                <? } ?>
            </div>
            <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$this->coordinator->phone;?>"><?=$this->coordinator->phone;?></a></div>
            <div class="email"><a href="mailto:<?=$this->coordinator->email;?>"><?=$this->coordinator->email;?></a></div>
            <div class="address">
                <div class="street"><?=$this->coordinator->street;?></div>
                <div class="zip"><?=$this->coordinator->zip;?></div>
                <div class="city"><?=$this->coordinator->city;?></div>
                <div class="country"><?=$this->coordinator->country;?></div>
            </div>
        <? } else { ?>
            <?= $this->data->trl('Koordinator wurde nicht gesetzt!'); ?>
        <? } ?>
    </div>
    <div class="talk-organiser">
        <h2><?=$this->data->trl('Vortragseinteiler');?></h2>
        <? if ($this->talk_organiser) { ?>
            <div class="name"><?=$this->talk_organiser->firstname.' '.$this->talk_organiser->lastname;?></div>
            <div class="degree">
                <? if ($this->talk_organiser->degree == 'eldest') { ?>
                    <?= $this->data->trl('Ältester'); ?>
                <? } else if ($this->talk_organiser->degree == 'ministry_assistent') { ?>
                    <?= $this->data->trl('DAG'); ?>
                <? } ?>
            </div>
            <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$this->talk_organiser->phone;?>"><?=$this->talk_organiser->phone;?></a></div>
            <div class="email"><a href="mailto:<?=$this->talk_organiser->email;?>"><?=$this->talk_organiser->email;?></a></div>
            <div class="address">
                <div class="street"><?=$this->talk_organiser->street;?></div>
                <div class="zip"><?=$this->talk_organiser->zip;?></div>
                <div class="city"><?=$this->talk_organiser->city;?></div>
                <div class="country"><?=$this->talk_organiser->country;?></div>
            </div>
        <? } else { ?>
            <?= $this->data->trl('Vortragseinteiler wurde nicht gesetzt!'); ?>
        <? } ?>
    </div>
    <div class="clear"></div>
    <div class="speakers-list">
        <h2><?=$this->data->trl('Redner');?></h2>
        <div class="speakers">
            <? foreach ($this->speakers as $speaker) { ?>
                <div class="speaker">
                    <div class="name"><?=$speaker->firstname.' '.$speaker->lastname; ?></div>
                    <div class="degree">
                        <? if ($speaker->degree == 'eldest') { ?>
                            <?= $this->data->trl('Ältester'); ?>
                        <? } else if ($speaker->degree == 'ministry_assistent') { ?>
                            <?= $this->data->trl('DAG'); ?>
                        <? } ?>
                    </div>
                    <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$speaker->phone;?>"><?=$speaker->phone;?></a></div>
                    <div class="email"><a href="mailto:<?=$speaker->email;?>"><?=$speaker->email;?></a></div>
                    <table class="talks">
                        <? $select = new Kwf_Model_Select(); ?>
                        <? $select->order('number');?>
                        <? foreach ($speaker->getChildRows('SpeakerToTalks', $select) as $talk) { ?>
                            <tr><td><?=$talk->number?></td><td><?=$talk->title;?></td>
                        <? } ?>
                    </table>
                </div>
            <? } ?>
        </div>
    </div>
</div>