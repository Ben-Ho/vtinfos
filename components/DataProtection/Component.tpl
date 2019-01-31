<div class="<?=$this->cssClass?>">
    <input type="hidden" class="config" value="<?=htmlspecialchars(json_encode($this->config))?>">
    <div class="popupWrapper">
        <h3>WICHTIG BITTE LESEN!</h3><br/>
        <div class="">Liebe Brüder,<br/>
um den neuen Datenschutzbestimmungen Folge zu leisten, muss jeder Redner zustimmen, dass seine personenbezogenen Daten (Name, Tel, Mail, Dienstamt) auf vtinfos gespeichert sein dürfen. Wenn dies bei euch bereits der Fall ist (ihr sie also gefragt habt), klickt auf „Zustimmungen erhalten“. Falls ihr nicht alle gefragt habt, klickt bitte auf „Beim nächsten Login erneut erinnern“. Fragt sie und stimmt beim nächsten mal einloggen zu.
Wir empfehlen euch das <a href="/media/Kwc_Basic_DownloadTag_Component/111-31-5-downloadTag/default/32613d2f/1525688078/erklaerung_www_vtinfos_com_ve.pdf">Formular herunterzuladen</a>, es euch von den einzelnen Rednern unterschreiben zu lassen und es dann bei euren Unterlagen aufzubewahren.<br/><br/>
Sollte einer eurer Redner nicht mehr wollen, dass seine Daten hier verwendet werden, so ist er umgehend aus der Liste zu entfernen.<br/><br/>
        </div>
        <?=$this->component($this->form)?>
        <button class="later"><?=$this->data->trl('Beim nächsten Login erneut erinnern');?></button>
    </div>
</div>
