<div class="<?=$this->rootElementClass?>">
    <h1 class="mainHeadline"><?=$this->data->trlKwf('Lost your password?')?></h1>
    <p>
        <?=$this->data->trl('Bitte gib deine E-Mail-Adresse ein. Falls kein Account mit deiner E-Mail-Adresse existiert, melde dich unter +43 699 12634150.')?>
    </p>
    <p>
        <?=$this->data->trl('Du erhältst ein E-Mail mit einem Link, mit dem du dein Passwort zurücksetzen kannst.')?>
    </p>

    <?=$this->component($this->form)?>
</div>
