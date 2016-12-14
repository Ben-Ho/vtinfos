<?php
class Update_20160913Update4dot2 extends Kwf_Update
{
    public function postMaintenanceBootstrap()
    {
        echo "Clearing all caches for 4.2 update:\n";
        passthru("php bootstrap.php clear-view-cache --all --force");
        passthru("php bootstrap.php clear-cache media");
    }
}
