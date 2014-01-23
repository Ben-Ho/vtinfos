<div class="<?=$this->cssClass?>">
    <h1><?=$this->data->trl('Versammlungs-Kreise');?></h1>
    <div class="circles">
        <? foreach ($this->circles as $name => $circleGroup) { ?>
            <div class="circle-group">
                <div class="container">
                    <div class="circle-group-name"><h2><?=$name;?></h2></div>
                    <div class="circles">
                        <? foreach ($circleGroup as $circle) { ?>
                            <div class="circle">
                                <div class="name"><h3><?=$circle->getRow()->name;?></h3></div>
                                <?= $this->component($circle);?>
                            </div>
                        <? } ?>
                    </div>
                </div>
            </div>
        <? } ?>
    </div>
</div>