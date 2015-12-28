<?php

class QdSetupOther extends QdRootSetup
{
    static $table_name = 'mpd_setup_other';

    public static function getFieldsConfig()
    {
        return array_merge(parent::getFieldsConfig(), array(
            'thongtinlh_tpl' => array(
                'DataType' => 'Code',
                'Caption' => array('en-US' => 'Conntact Info Tpl', 'vi-VN' => 'Thông tin LH Tpl'),
                'Description' => array(
                    'vi-VN' => 'Định nghĩa mẫu HTML cho Field \'Thông tin liên hệ\' của Bất động sản',
                ),
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdTemplate',
                    'Field' => 'id',
                    'TableFilter' => array(
                        array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'type',
                            'Type' => 'CONST',
                            'Value' => QdTemplate::$TYPE_BDS
                        )
                    )
                ),
                'DataPort' => 'setup_other_port'
            ),
        ));
    }
}