<div class="<?=$this->cssClass?>">
    <input type="hidden" class="config" value="<?=htmlspecialchars(json_encode($this->config))?>">
    <div class="popupWrapper">
        <h3>WICHTIG BITTE LESEN!</h3><br/>
        <div class="">Liebe Brüder,<br/>
um den neuen Datenschutzbestimmungen Folge zu leisten, muss jeder Redner (bis 25.5.2018) zustimmen, dass seine personenbezogenen Daten (Name, Tel, Mail, Dienstamt) auf vtinfos gespeichert sein dürfen. Wenn dies bei euch bereits der Fall ist (ihr sie also gefragt habt), klickt auf „Zustimmungen erhalten“. Falls ihr nicht alle gefragt habt, klickt bitte auf „Beim nächsten Login erneut erinnern“. Fragt sie und stimmt beim nächsten mal einloggen zu.
Wir empfehlen euch das Formular herunterzuladen, es euch von den einzelnen Rednern unterschreiben zu lassen und es dann bei euren Unterlagen aufzubewahren.<br/><br/>
Leider müssen wir alle Versammlungen/Redner die bis 25.5.2018 nicht zugestimmt haben für den Moment aus der Seite entfernen. (Natürlich können sie dann auf Wunsch und nach erhaltener Zustimmung wieder eingefügt werden)<br/><br/>
        </div>
        <?=$this->component($this->form)?>
        <button class="later"><?=$this->data->trl('Beim nächsten Login erneut erinnern');?></button>
    </div>
</div>
