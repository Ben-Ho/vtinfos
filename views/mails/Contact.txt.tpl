Anfrage über:
<?php  if ($this->topic == 'newCongregation') {
    echo 'Neue Versammlung';
} else if ($this->topic == 'bug') {
    echo 'Fehler auf der Seite gefunden';
} else if ($this->topic == 'wishes') {
    echo 'Wunsch';
} else if ($this->topic == 'miscellaneous') {
    echo 'Sonstiges';
}?>


<?= $this->content; ?>


Anfrage wurde gesendet von:
Name: <?= $this->firstname; ?> <?= $this->lastname; ?>

Email: <?= $this->email; ?>
