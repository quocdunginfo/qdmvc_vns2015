<?php

class QdProductCat extends QdRoot
{
    static $table_name = 'mpd_product_cat';
    public static $TYPE_PRODUCTCAT = 'LOAISP';
    public static $TYPE_MANUFACTOR = 'HANGSX';

    public static $LV1_DF = '';
    public static $LV1_BAN = 'BAN';
    public static $LV1_CHOTHUE = 'CHOTHUE';
    public static $LV1_OTHER = 'OTHER';

    public function __construct(array $attributes = array(), $guard_attributes = true, $instantiating_via_find = false, $new_record = true)
    {
        parent::__construct($attributes, $guard_attributes, $instantiating_via_find, $new_record);
        $this->SETFILTERDEFAULT(array(
            array('field' => 'type', 'value' => static::$TYPE_PRODUCTCAT, 'operator' => static::$OP_EQUAL)
        ));
    }

    /*
    static $has_many = array(
        array('product_list', 'class_name' => 'QdProduct', 'primary_key' => 'id', 'foreign_key' => 'product_cat_id')
    );*/
    public static function getInitObj()
    {
        $obj = new QdProductCat();
        $obj->type = static::$TYPE_PRODUCTCAT;
        $obj->active = true;
        return $obj;
    }

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            'name' => array(
                'Caption' => array('vi-VN' => 'Tên Vị trí'),
            ),
            'avatar' => array(
                'Caption' => array('en-US' => 'Avatar', 'vi-VN' => 'Hình đại diện'),
                'DataType' => 'Image',
                'Description' => 'Hình đại diện'
            ),
            'active' => array(
                'DataType' => 'Boolean',
            ),
            'type' => array(
                'Caption' => array('vi-VN' => 'Phân loại'),
            ),
            'order' => array(
                'Caption' => array('vi-VN' => 'Thứ tự'),
            ),
            'level' => array(
                'DataType' => 'Integer',
                'ReadOnly' => true
            ),
            '_parent_name' => array(
                'Name' => '_parent_name',
                'Caption' => array('en-US' => 'Parent Name', 'vi-VN' => 'Tên cha'),
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'FieldClass_FlowField' => array(
                    'Method' => 'Lookup',
                    'Table' => 'QdProductCat',
                    'Field' => 'name',
                    'TableFilter' => array(
                        0 => array(
                            'Field' => 'id',
                            'Type' => 'FIELD',
                            'Value' => 'parent_id'
                        )
                    )
                )
            ),
            '_product_count' => array(
                'Caption' => array('en-US' => 'SL BDS', 'vi-VN' => 'SL BDS'),
                'DataType' => 'Integer',
                'FieldClass' => 'FlowField',
                'FieldClass_FlowField' => array(
                    'Method' => 'Count',
                    'Table' => 'QdProduct',
                    'Field' => 'id',
                    'TableFilter' => array(
                        'product_cat_id' => array(
                            'Field' => 'product_cat_id',
                            'Type' => 'FIELD',
                            'Value' => 'id'
                        ),
                        /*
                        array(
                            'Field' => 'active',
                            'Type' => 'FILTER',
                            'Value' => '=1',
                        )
                        */
                    )
                )
            ),
            'parent_id' => array(
                'Name' => 'parent_id',
                'Caption' => array('en-US' => 'Parent ID', 'vi-VN' => 'Mã LSP cha'),
                'DataType' => 'Code',
                'Description' => '',
                'Editable' => true,
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdProductCat',
                    'Field' => 'id',
                    'TableFilter' => array(
                    )
                )
            ),
            '_permalink' => array(
                'Name' => '_permalink',
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
            ),
            'longitude' => array(
                'Caption' => array('en-US' => 'Longitude', 'vi-VN' => 'Kinh độ'),
                'DataType' => 'Decimal',
                'Description' => 'Dùng để hiển thị trên Google Map',
                'FieldClass' => 'Normal',
            ),
            'latitude' => array(
                'Caption' => array('en-US' => 'Latitude', 'vi-VN' => 'Vĩ độ'),
                'DataType' => 'Decimal',
                'Description' => 'Dùng để hiển thị trên Google Map',
                'FieldClass' => 'Normal',
            ),
        ));
        $obj['__sys_lines_url']['TableRelation'] = array(
            'Table' => 'QdProduct',
            'Field' => 'id',
            'TableFilter' => array(
                array(
                    'Condition' => array(
                        'Field' => '',
                        'Type' => 'CONST',//'FIELD'
                        'Value' => ''
                    ),
                    'Field' => 'product_cat_id',
                    'Type' => 'FIELD',
                    'Value' => 'id'
                )
            )
        );
        $obj['id']['ReadOnly'] = false;

        return $obj;
    }

    public function getProducts()
    {
        $obj = new QdProduct();
        $obj->SETFILTERDEFAULT(array(array('field' => 'product_cat_id', 'value' => $this->id, 'exact' => true, 'operator' => '=')));
        return $obj;
    }

    public function getPermalink($appedned_query=false)
    {
        $query = get_permalink(Qdmvc_Helper::getPageIdByTemplate('page-templates/product-search.php'));
        $query = add_query_arg(array('loc-id' => $this->id), $query);
        if(is_array($appedned_query) && !empty($appedned_query)){
            $query = add_query_arg($appedned_query, $query);
        }
        return $query;
        /*
        $query =  get_site_url();
        $query .= sprintf('/loaisp/%s/%s', $this->id, Qdmvc_Helper::sanitize_title_with_dashes($this->name));
        return $query;*/
    }

    public function getProductsSegmentURL($offset = 0)
    {
        $query = get_permalink($this->getPermalink());
        $query = add_query_arg(array('id' => $this->id, 'product-offset' => $offset), $query);
        return $query;
    }

    public function getProductsSegment($limit = 2, $offset = 0)
    {
        //return QdProduct::all(array('conditions' => 'product_cat_id = '.$this->id, 'limit' => $limit, 'offset' => $offset, 'order' => 'id desc'));
        return $this
            ->getProducts()
            ->REMOVEFILTER()
            ->SETLIMIT($limit)
            ->SETOFFSET($offset)
            ->SETORDERBY('id', 'desc')
            ->GETLIST();
    }

    public function getBreadcrumbs()
    {
        $re = array();
        $product_search = get_permalink(Qdmvc_Helper::getPageIdByTemplate('page-templates/product-search.php'));
        array_push($re, array('name' => 'Sản phẩm', 'url' => $product_search));
        $p = $this;
        $tmp = array();
        while($p!=null){
            array_push($tmp, array('name' => $p->name, 'url' => $p->getPermalink()));
            $p = $p->getParentObj();
        }
        $tmp = array_reverse($tmp);
        $re = array_merge($re, $tmp);
        return $re;
    }

    protected function orderOnValidate($field_name)
    {
        if ($this->$field_name <= 0) {
            //$this->pushValidateError($field_name, 'Order phải lớn hơn 0');
        }
    }

    protected function parent_idOnValidate($field_name)
    {
        //check exit
        if ($this->$field_name != '') {
            $p = QdProductCat::GET($this->$field_name);
            if ( $p == null) {
                $this->pushValidateError($field_name, 'Product Cat không tồn tại!');
                if (!$this->is_new_record()) {
                    $this->$field_name = $this->xRec()->$field_name;
                }
                return false;
            }
            if($this->$field_name == $this->id) {
                $this->pushValidateError($field_name, 'Không thể chọn cha là chính nó!');
                return false;
            }
        }
        $this->level = $this->getDeepLevel();
        $this->levelOnValidate('level');
    }

    protected function levelOnValidate($field_name)
    {
        if($this->$field_name === 3){
            $this->struct_lv_3 = $this->id;
            $this->pushValidateError($field_name, 'Tự động gán struct_lv_3 = id!', 'info');
        }
    }


    protected function avatarOnValidate($field_name)
    {
        if ($this->$field_name == '') {

        }
    }

    public function getDeepLevel()
    {
        $p = static::GET($this->parent_id);
        if ($p == null) {
            return 1;
        } else {
            return $p->getDeepLevel() + 1;
        }
    }

    public static function genObjectsToArray($list)
    {
        $re = array();
        foreach ($list as $item) {
            array_push($re, array(
                'id' => $item->id,
                'title' => $item->name,
                'url' => 'http://google.com',
                'active' => true,
                'deep' => $item->getDeepLevel(),
                'parent_id' => $item->parent_id
            ));
        }
        return $re;
    }

    public function getParentObj()
    {
        return QdProductCat::GET($this->parent_id);
    }

    public function fn_validate_all_level($loc, $params)
    {
        $tmp = new QdProductCat();
        //$tmp->SETRANGE('type', static::$TYPE_PRODUCTCAT);
        $count = 0;
        foreach ($tmp->GETLIST() as $item) {
            if ($item->save()) {
                $count++;
            }
        }
        $this->pushValidateError('', 'Total items validated: ' . $count, 'info');
        return true;
    }

    public static function getPermalinkSearchPageStruct($struct_id)
    {
        $query = get_permalink(Qdmvc_Helper::getPageIdByTemplate('page-templates/bds-list.php'));
        $query = add_query_arg(array('struct-id' => $struct_id), $query);
        return $query;
    }

    protected function CALCFIELDS($flowfield_name)
    {
        if ($flowfield_name == '_permalink') {
            $this->qd_cached_attr[$flowfield_name] = $this->getPermalink();
            //return
            return $this->qd_cached_attr[$flowfield_name];
        }

        return parent::CALCFIELDS($flowfield_name);
    }

    public function GETRTABLES()
    {
        return array(
            'QdProduct' => array(
                'product_cat_id'
            )
        );
    }

    protected function TABLECAPTION()
    {
        return array(
            'vi-VN' => 'Loại SP',
            'en-US' => 'Product Cat'
        );
    }


}