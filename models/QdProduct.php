<?php

class QdProduct extends QdRoot
{
    static $table_name = 'mpd_product';
    public static $STOCK_DF = '';
    public static $STOCK_FINISH = 'FINISH';
    public static $STOCK_NGUNG = 'NGUNG';

    public static function getFieldsConfig()
    {
        $obj = array_merge(parent::getFieldsConfig(), array(
            //SAMPLE FIELD CONFIG
            '_seo_title_preview' => array(
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'Description' => array(
                    'vi-VN' => sprintf(Qdmvc_Message::getMsg('fd_seometa_field_title'), 'chi tiết BDS')
                )
            ),
            '_seo_description_preview' => array(
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
                'Description' => array(
                    'vi-VN' => sprintf(Qdmvc_Message::getMsg('fd_seometa_field_description'), 'chi tiết BDS')
                )
            ),
            //SAMPLE FIELD CONFIG
            '_product_cat_name' => array(
                'Name' => '_product_cat_name',
                'Caption' => array('en-US' => 'Product Cat Name', 'vi-VN' => 'Vị trí BDS'),
                'Description' => array(//'vi-VN' => 'Tên loại SP ứng với mã SP'
                ),
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
                            'Value' => 'product_cat_id'
                        )
                    )
                )
            ),
            //SAMPLE FIELD CONFIG
            '_price_discount' => array(
                'Name' => '_price_discount',
                'DataType' => 'Decimal',
                'FieldClass' => 'FlowField',
                'Description' => array(
                    'vi-VN' => sprintf('Giá sau khi giảm - sửa Field \'discount_percent\' để thay đổi')
                ),
            ),
            'product_cat_id' => array(
                'Name' => 'product_cat_id',
                'Caption' => array('en-US' => 'Product Cat ID', 'vi-VN' => 'Mã Vị trí BDS'),
                'DataType' => 'Code',
                'Numeric' => true,
                'Description' => array(//'vi-VN' => sprintf('Mã SP')
                ),
                'Editable' => true,
                'InitValue' => '0',
                'FieldClass' => 'Normal',//'FlowField'
                'TableRelation' => array(
                    'Table' => 'QdProductCat',
                    'Field' => 'id',
                    'TableFilter' => array(
                        /*array(
                            'Condition' => array(
                                'Field' => '',
                                'Type' => 'CONST',//'FIELD'
                                'Value' => ''
                            ),
                            'Field' => 'level',
                            'Type' => 'CONST',
                            'Value' => 3
                        )*/
                    )
                ),
                'DataPort' => 'product_cat_port'
            ),
            'avatar' => array(
                'Caption' => array('en-US' => 'Avatar', 'vi-VN' => 'Hình đại diện'),
                'DataType' => 'Image',
                'Description' => array(
                    'vi-VN' => 'Hình đại diện hiển thị ở trang tìm kiếm SP hoặc những khu vực tương tự (hình đơn)<br>Muốn chọn nhiều hình cho trang chi tiết SP, dùng chức năng \'Hình ảnh\' để thêm hình'
                ),
                'Require' => true
            ),
            '_avatar_preview' => array(
                'Caption' => array('en-US' => 'Image Preview', 'vi-VN' => 'Xem trước'),
                'DataType' => 'ImagePreview',
                'FieldClass' => 'System',
                'ImagePreviewField' => 'avatar'
            ),
            'active' => array(
                'Caption' => array('en-US' => 'Active', 'vi-VN' => 'Kích hoạt'),
                'DataType' => 'Boolean',
                'InitValue' => true,
                'Description' => array(
                    'vi-VN' => 'Có hiển thị ra ngoài Web hay không ?'
                ),
                'ReadOnly' => true
            ),
            'name' => array(
                'Caption' => array('vi-VN' => 'Tên SP'),
                'Require' => true
            ),
            /*
            'code' => array(
                'Caption' => array('vi-VN' => 'Mã SP'),
                'Description' => array(
                    'vi-VN' => 'Mã BDS hiển thị trên trang chi tiết BDS'
                ),
            ),*/
            'price' => array(
                'Caption' => array('vi-VN' => 'Giá'),
            ),
            'description' => array(
                'Caption' => array('vi-VN' => 'Mô tả'),
                'DataType' => 'WYSIWYG',
                'Description' => array(
                    'vi-VN' => 'Thông tin mô tả phía dưới Hình đại diện, trang chi tiết BDS'
                ),
                'Require' => true
            ),
            'stock_status' => array(
                'Caption' => array('vi-VN' => 'Tình trạng BDS'),
                'DataType' => 'Option',
                'Description' => array(
                    'vi-VN' => 'Đánh dấu tình trạng kho của SP'
                ),
                'Options' => array(
                    static::$STOCK_DF => array(
                        'Caption' => array('en-US' => 'Default', 'vi-VN'=> 'Mặc định')
                    ),
                    static::$STOCK_FINISH => array(
                        'Caption' => array('en-US' => 'Finish', 'vi-VN'=> 'Đã hoàn tất')
                    ),
                    static::$STOCK_NGUNG => array(
                        'Caption' => array('en-US' => 'Stop', 'vi-VN'=> 'Ngưng giao dịch')
                    )
                )
            ),
            'discount_percent' => array(
                'DataType' => 'Decimal',
                'Caption' => array('en-US' => 'Manual Discount Amt', 'vi-VN' => '% Giảm giá'),
                'Description' => array(
                    'vi-VN' => '% giảm giá so với Field \'Giá\', nhập số thập phân vd: 0.56<br>Độ ưu tiên thấp hơn \'Giảm giá\''
                ),
            ),
            'struct_lv_1' => array(
                'Caption' => array('en-US' => 'Category', 'vi-VN' => 'Nhóm SP'),
                'DataType' => 'Option',
                'Options' => array(
                    QdProductCat::$LV1_DF => array(
                        'Caption' => array('en-US' => 'Default', 'vi-VN' => 'Mặc định'),
                    ),
                    QdProductCat::$LV1_BAN => array(
                        'Caption' => array('en-US' => 'Selling', 'vi-VN' => 'Bán'),
                    ),
                    QdProductCat::$LV1_CHOTHUE => array(
                        'Caption' => array('en-US' => 'For rent', 'vi-VN' => 'Cho thuê'),
                    ),
                )
            ),
            'price_range_type' => array(

            ),
            'noseries' => array(),
            '_permalink' => array(
                'Name' => '_permalink',
                'DataType' => 'Text',
                'FieldClass' => 'FlowField',
            ),
            'manual_discount_amt' => array(
                'Caption' => array('en-US' => 'Manual Discount Amt', 'vi-VN' => 'Giảm giá'),
                'DataType' => 'Integer',
                'Description' => array(
                    'vi-VN' => 'Giá giảm giá so với \'Giá\', nhập số nguyên vd: 135000<br>Độ ưu tiên cao hơn \'% Giảm giá\''
                ),
            ),
            'dtdat' => array(
                'DataType' => 'Decimal',
                'Caption' => array('en-US' => 'Dien tich dat', 'vi-VN' => 'Diện tích đất'),
                'Description' => array(
                    'vi-VN' => ''
                ),
            ),
            'dtxaydung' => array(
                'DataType' => 'Decimal',
                'Caption' => array('en-US' => 'Dien tich xay dung', 'vi-VN' => 'Diện tích xây dựng'),
                'Description' => array(
                    'vi-VN' => 'Hiển thị trên trang chi tiết BDS'
                ),
            ),
            'dtsudung' => array(
                'DataType' => 'Decimal',
                'Caption' => array('en-US' => 'Dien tich su dung', 'vi-VN' => 'Diện tích sử dụng'),
                'Description' => array(
                    'vi-VN' => 'Hiển thị trên trang chi tiết BDS'
                ),
            ),
            'phaply' => array(
                'DataType' => 'WYSIWYG',
                'Caption' => array('en-US' => 'Phap ly', 'vi-VN' => 'Pháp lý'),
                'Description' => array(
                    'vi-VN' => 'Pháp lý'
                ),
            ),
            'thongtinlh' => array(
                'DataType' => 'WYSIWYG',
                'Caption' => array('en-US' => 'Contact Info', 'vi-VN' => 'Thông tin liên hệ'),
                'Description' => array(
                    'vi-VN' => 'Định nghĩa trong \'Cấu hình khác\'',
                ),
            ),
            'ggm_embeded' => array(
                'DataType' => 'Text',
                'Caption' => array('en-US' => 'Google Map Embeded', 'vi-VN' => 'Mã nhúng Google Map'),
                'Description' => array(
                    'vi-VN' => 'Mã nhúng Google dạng iFrame',
                ),
            ),
        ));
        $obj['id']['Description'] = array(
            'vi-VN' => sprintf('Mã BDS quản lý trong hệ thống, không hiển thị trên Web<br>Muốn hiển thị mã trên Web, dùng Field \'%s\'', $obj['code']['Caption']['vi-VN'])
        );
        $obj['__sys_lines_url']['Caption'] = array('en-US' => 'Related Products', 'vi-VN' => 'BDS liên kết');
        $obj['__sys_lines_url']['TableRelation'] = array(
            'Table' => 'QdPro2Pro',
            'Field' => 'id',
            'TableFilter' => array(
                array(
                    'Condition' => array(
                        'Field' => '',
                        'Type' => 'CONST',//'FIELD'
                        'Value' => ''
                    ),
                    'Field' => 'product_id',
                    'Type' => 'FIELD',
                    'Value' => 'id'
                )
            )
        );

        $obj['__sys_seometa_url'] = array(
            'FieldClass' => 'System',
            'Caption' => array('en-US' => 'SEO Meta', 'vi-VN' => 'SEO Meta'),
            'TableRelation' => array(
                'Table' => 'QdSEOMeta',
                'Field' => 'id',
                'TableFilter' => array(
                    array(
                        'Condition' => array(
                            'Field' => '',
                            'Type' => 'CONST',//'FIELD'
                            'Value' => ''
                        ),
                        'Field' => 'model_id',
                        'Type' => 'FIELD',
                        'Value' => 'id'
                    ),
                    array(
                        'Condition' => array(
                            'Field' => '',
                            'Type' => 'CONST',//'FIELD'
                            'Value' => ''
                        ),
                        'Field' => 'model',
                        'Type' => 'CONST',
                        'Value' => 'QdProduct'
                    )
                )
            ));
        $obj['id']['ReadOnly'] = false;
        /*
        $obj['__sys_lines_url'] = array(
            'FieldClass' => 'System',
            'Caption' => array('en-US' => 'UOM', 'vi-VN' => 'Đơn vị tính'),
            'TableRelation' => array(
                'Table' => 'QdProUOM',
                'Field' => 'id',
                'TableFilter' => array(
                    array(
                        'Condition' => array(
                            'Field' => '',
                            'Type' => 'CONST',//'FIELD'
                            'Value' => ''
                        ),
                        'Field' => 'product_id',
                        'Type' => 'FIELD',
                        'Value' => 'id'
                    )
                )
            )
        );*/
        $obj['__sys_lines_url']['TableRelation'] = array(
            'Table' => 'QdPro2Pro',
            'Field' => 'id',
            'TableFilter' => array(
                array(
                    'Field' => 'product_id',
                    'Type' => 'FIELD',
                    'Value' => 'id'
                ),
            )
        );
        return $obj;
    }

    static $alias_attribute = array(
        'model' => 'code'
    );
    static $belongs_to = array(
        array('product_cat_obj', 'class_name' => 'QdProductCat', 'foreign_key' => 'product_cat_id', 'primary_key' => 'id')
    );

    public function getProductCatObj()
    {
        return $this->product_cat_obj;
    }

    public function getPermalink()
    {
        //$query = get_permalink(Qdmvc_Helper::getPageIdByTemplate('page-templates/bds-detail.php'));
        //$query = add_query_arg(array('id' => $this->id), $query);

        //$query = site_url(sprintf('%s/%s.html', Qdmvc_Helper::sanitize_title_with_dashes($this->name), $this->id));
        //return $query;

        $tmp = site_url(sprintf('%s/%s.html', Qdmvc_Helper::sanitize_title_with_dashes($this->name), $this->id));
        return $tmp;
    }

    public function getBreadcrumbs()
    {
        $re = array();
        if($this->getProductCatObj()!=null){
            $re = $this->getProductCatObj()->getBreadcrumbs();
        }
        array_push($re, array('name' => $this->name, 'url' => $this->getPermalink()));
        return $re;
    }

    /*
     * Validation
     *
     */
    protected function nameOnValidate($field_name)
    {

    }

    protected function activeOnValidate($field_name)
    {
        /*
        if($this->active ==0 && $this->active != $this->xRec()->active)
        {
            if($this->code != 1)
            {
                $this->pushValidateError($field_name, 'Code phải bằng 1 mới tắt được Active');
            }
        }
        */
    }

    protected function codeOnValidate($field_name)
    {
        if ($this->$field_name == '') {
            if ($this->name != null) {
                $this->pushValidateError($field_name, 'Code tự động in hoa và bằng ID', 'info');
                $this->$field_name = strtoupper($this->id);
            }
        }
    }

    protected function priceOnValidate($field_name)
    {
        if ($this->$field_name != '' && $this->$field_name <= 0) {
            $this->pushValidateError($field_name, 'Price phải lớn hơn 0', 'error');
        }
    }

    protected function product_cat_idOnValidate($field_name)
    {
        //check exit
        $pc = $this->getProductCatObj();
        if ($pc == null) {
            $this->pushValidateError($field_name, 'Product Cat không tồn tại!');
            if (!$this->is_new_record()) {
                $this->$field_name = $this->xRec()->$field_name;
            }
        }
    }

    protected function avatarOnValidate($field_name)
    {
        if ($this->$field_name == '') {
            $this->pushValidateError($field_name, 'Hình đại diện bắt buộc phải nhập', 'error');
        }
    }


    public static function getInitObj()
    {
        $obj = new QdProduct();
        //get default tpl
        $tpl = QdSetupOther::GET();
        if($tpl!=null && $tpl->thongtinlh_tpl!=''){
            $tpl2 = QdTemplate::GET($tpl->thongtinlh_tpl);
            if($tpl2!=null && $tpl2->content!=''){
                $obj->thongtinlh = $tpl2->content;
            }
        }
        $obj->struct_lv_1 = QdProductCat::$LV1_BAN;
        return $obj;
    }

    public function fn_active($location, $params)
    {
        //static::connection()->transaction();

        if (!$this->checkPermission(__FUNCTION__)) return false;

        $this->active = !$this->active;
        $this->save(true, $location . '|' . $this->getCalledClassName() . '|fn_active');
        $this->pushValidateError('active', 'Active thành công', 'info');

        //static::connection()->rollback();
        return array('subinfo' => 'Tiến trình hoàn tất!', 'subinfo2' => true);
    }

    public function getRProducts2()
    {
        $re = array();
        $record = new QdPro2Pro();
        $record->SETRANGE('product_id', $this->id);
        $tmp = $record->GETLIST();
        foreach ($tmp as $item) {
            $tmp2 = QdProduct::GET($item->r_product_id);
            if ($tmp2 != null) {
                array_push($re, $tmp2);
            }
        }
        return $re;
    }

    protected function CALCFIELDS($flowfield_name)
    {
        if ($flowfield_name == '_permalink') {
            $this->qd_cached_attr[$flowfield_name] = $this->getPermalink();
            //return
            return $this->qd_cached_attr[$flowfield_name];
        }
        if ($flowfield_name == '_price_discount') {
            $tmp = 0;
            if($this->manual_discount_amt > 0){
                $tmp = $this->price - $this->manual_discount_amt;
            } else if($this->discount_percent > 0){
                $tmp = $this->price - ($this->price * $this->discount_percent);
            }

            $this->qd_cached_attr[$flowfield_name] = $tmp;
            //return
            return $tmp;
        } else if ($flowfield_name == '_seo_title_preview') {
            $seo = $this->getSEOMeta();
            foreach ($seo as $item) {
                if ($item->meta_name == QdSEOMeta::$META_NAME_TITLE) {
                    $this->qd_cached_attr[$flowfield_name] = $item->_meta_value_preview;
                    return $this->qd_cached_attr[$flowfield_name];
                }
            }
        } else if ($flowfield_name == '_seo_description_preview') {
            $seo = $this->getSEOMeta();
            foreach ($seo as $item) {
                if ($item->meta_name == QdSEOMeta::$META_NAME_DESCRIPTION) {
                    $this->qd_cached_attr[$flowfield_name] = $item->_meta_value_preview;
                    return $this->qd_cached_attr[$flowfield_name];
                }
            }
        }
        return parent::CALCFIELDS($flowfield_name);
    }
    public function fn_remove_ggm_embeded($location, $params)
    {
        if (!$this->checkPermission(__FUNCTION__)) return false;

        $this->ggm_embeded = '';
        $this->save(true, $location . '|' . $this->getCalledClassName() . '|fn_remove_ggm_embeded');
        $this->pushValidateError('ggm_embeded', 'Gỡ Google Map thành công', 'info');

        return true;
    }
    public function fn_validate_all_struct_level($location, $params)
    {
        $tmp = new QdProduct();
        $re = $tmp->GETLIST();
        $count = 0;
        foreach ($re as $item) {
            if ($item->save()) {
                $count++;
            }
        }
        $this->pushValidateError('', 'Total items validated: ' . $count, 'info');
    }

    public function getSEOMeta()
    {
        $obj = parent::getSEOMeta(); // TODO: Change the autogenerated stub
        $title_found = false;
        $desc_found = false;
        foreach ($obj as $item) {
            if ($item->meta_name == QdSEOMeta::$META_NAME_TITLE) {
                $title_found = true;
            } else if ($item->meta_name == QdSEOMeta::$META_NAME_DESCRIPTION) {
                $desc_found = true;
            }
        }
        if (!$title_found) {
            $tmp = new QdSEOMeta();
            $tmp->active = true;
            $tmp->overwrite = false;
            $tmp->seo_tpl = 1;
            $tmp->meta_name = QdSEOMeta::$META_NAME_TITLE;
            $tmp->meta_value = $this->name;
            array_push($obj, $tmp);
        }
        if (!$desc_found) {
            $tmp = new QdSEOMeta();
            $tmp->active = true;
            $tmp->overwrite = true;
            $tmp->seo_tpl = 1;
            $tmp->meta_name = QdSEOMeta::$META_NAME_DESCRIPTION;

            $price = number_format($this->_price_discount, 0, '.', ',') . ' VND';
            if ($this->discount_percent > 0) {
                $price .= ' (' . ($this->discount_percent * 100) . '% OFF)';
            }
            $tmp->meta_value = substr(strip_tags($this->description), 0, 80) . '...' . $price;

            array_push($obj, $tmp);
        }
        return $obj;
    }
    protected function TABLECAPTION()
    {
        return array(
            'vi-VN' => 'Sản phẩm',
            'en-US' => 'Product'
        );
    }
}