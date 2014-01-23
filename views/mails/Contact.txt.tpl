<?=$this->data->trl('Kontakt-Formular auf {0} ausgefüllt:', $this->host);?>.


<?=$this->data->trl('Anfrage über');?>: <?=$this->topic;?>
<?= $this->content; ?>


<?=$this->data->trl('Anfrage wurde gesendet von');?>:

<?=$this->data->trl('Name');?>: <?= $this->firstname; ?> <?= $this->lastname; ?>

<?=$this->data->trl('Email');?>: <?= $this->email; ?>
