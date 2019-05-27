<?php
class Root_Component extends Kwc_Root_TrlRoot_Component implements Kwf_Util_Maintenance_JobProviderInterface
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['generators']['master']['component'] = 'Root_Master_Component';
        $ret['generators']['chained']['component'] = 'Root_Chained_Component.Root_Master_Component';

        $ret['childModel'] = new Kwc_Root_TrlRoot_Model(array(
            'de' => 'Deutsch',
            'en' => 'English'
        ));

        $ret['editComponents'] = array();

        $ret['assets']['files'][] = 'web/components/Root/Web.scss';
        return $ret;
    }

    public static function getMaintenanceJobs()
    {
        return array(
            'SyncCongregationDetailsFromApi',
            'DeleteDeletedSpeakersJob'
        );
    }
}
