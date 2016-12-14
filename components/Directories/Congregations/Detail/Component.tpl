<div class="<?=$this->rootElementClass?>">
    <?=$this->component($this->lastChange);?>
    <h1><?=$this->row->name;?></h1>
    <a class="downloadPdf" href="<?=$this->pdfDownloadUrl;?>" target="_blank"><img src="/assets/web/images/downloadPdf.png" width="35" height="35"></a>
    <div class="circle"><span class="label"><?=$this->data->trl('Kreis');?>:</span><span class"value"><?=$this->row->circle_name;?></span></div>
    <div class="congregation-info">
        <div class="time">
            <div class="talk-time"><span class="label"><?=$this->data->trl('Vortragszeit:');?></span> <?=$this->row->talk_time;?></div>
            <div class="ministryschool-time"><span class="label"><?=$this->data->trl('Leben- und Dienstzusammenkunft');?>:</span> <?=$this->row->ministryschool_time;?></div>
        </div>
        <div class="address">
            <?=$this->address;?>
            <a target="_blank" href="<?=$this->gmapUrl;?>">
                <img src="/assets/silkicons/map.png" width="16" height="16"
                    alt="<?=$this->data->trl('Adresse in Maps öffnen');?>"/>
            </a>
        </div>
        <div class="note"><?=$this->row->note;?></div>
    </div>
    <div class="coordinator">
        <h2><?=$this->data->trl('Koordinator');?></h2>
        <?php  if ($this->coordinator) { ?>
            <div class="name">
                <span class="lastname"><?=$this->coordinator->lastname;?></span>&nbsp;
                <span class="firstname"><?=$this->coordinator->firstname;?></span>
            </div>
            <div class="degree">
                <?php  if ($this->coordinator->degree == 'e') { ?>
                    <?= $this->data->trl('Ä'); ?>
                <?php  } else if ($this->coordinator->degree == 'm') { ?>
                    <?= $this->data->trl('DAG'); ?>
                <?php  } ?>
            </div>
            <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$this->coordinator->phone;?>"><?=$this->coordinator->phone;?></a></div>
            <div class="email"><a href="mailto:<?=$this->coordinator->email;?>"><?=$this->coordinator->email;?></a></div>
        <?php  } else { ?>
            <?= $this->data->trl('Koordinator wurde nicht gesetzt!'); ?>
        <?php  } ?>
    </div>
    <div class="talk-organiser">
        <h2><?=$this->data->trl('Vortragseinteiler');?></h2>
        <?php  if ($this->talk_organiser) { ?>
            <div class="name">
                <span class="lastname"><?=$this->talk_organiser->lastname;?></span>&nbsp;
                <span class="firstname"><?=$this->talk_organiser->firstname;?></span>
            </div>
            <div class="degree">
                <?php  if ($this->talk_organiser->degree == 'e') { ?>
                    <?= $this->data->trl('Ä'); ?>
                <?php  } else if ($this->talk_organiser->degree == 'm') { ?>
                    <?= $this->data->trl('DAG'); ?>
                <?php  } ?>
            </div>
            <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$this->talk_organiser->phone;?>"><?=$this->talk_organiser->phone;?></a></div>
            <div class="email"><a href="mailto:<?=$this->talk_organiser->email;?>"><?=$this->talk_organiser->email;?></a></div>
        <?php  } else { ?>
            <?= $this->data->trl('Vortragseinteiler wurde nicht gesetzt!'); ?>
        <?php  } ?>
    </div>
    <div class="kwfUp-clear"></div>
    <div class="speakers-list">
        <h2><?=$this->data->trl('Redner');?></h2>
        <div class="speakers">
            <?php  foreach ($this->speakers as $speaker) { ?>
                <div class="speaker">
                    <div class="name">
                        <span class="lastname"><?=$speaker['row']->lastname;?></span>&nbsp;
                        <span class="firstname"><?=$speaker['row']->firstname;?></span>
                    </div>
                    <div class="degree">
                        <?php  if ($speaker['row']->degree == 'e') { ?>
                            <?= $this->data->trl('Ä'); ?>
                        <?php  } else if ($speaker['row']->degree == 'm') { ?>
                            <?= $this->data->trl('DAG'); ?>
                        <?php  } ?>
                    </div>
                    <div class="phone"><?=$this->data->trl('Tel:');?> <a href="tel:<?=$speaker['row']->phone;?>"><?=$speaker['row']->phone;?></a></div>
                    <div class="email"><a href="mailto:<?=$speaker['row']->email;?>"><?=$speaker['row']->email;?></a></div>
                    <div class="note"><?=$speaker['row']->note;?></div>
                    <table class="talks">
                        <?php  foreach ($speaker['talks'] as $talk) { ?>
                            <tr>
                                <td><?=$talk['number']?></td>
                                <td><?=$talk['title'];?></td>
                                <td><?=$talk['language'];?></td>
                            </tr>
                        <?php  } ?>
                    </table>
                </div>
            <?php  } ?>
        </div>
    </div>
</div>
