<?php
/**
 * Created by PhpStorm.
 * User: quocd_000
 * Date: 08/02/2015
 * Time: 11:32 PM
 */
Qdmvc::loadLayout('layout_cardnavigate');

class Qdmvc_View_SEOMeta extends Qdmvc_Layout_CardNavigate
{
    protected function onReadyHook()
    {
        parent::onReadyHook(); // TODO: Change the autogenerated stub
        ?>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $("#cardForm select[name='meta_name']").on('change', function () {
                        if ($(this).val().toLowerCase() == 'description') {
                            $("#cardForm select[name='seo_tpl']").attr('disabled', 'disabled');
                            MYAPP.showMsg({
                                "6tydh543678dgvcgftery": {
                                    "field": "",
                                    "msg": "SEO TPL không dùng cho " + $(this).val(),
                                    "type": "info"
                                }
                            });
                        }
                        else {
                            $("#cardForm select[name='seo_tpl']").removeAttr('disabled');
                        }
                    });
                });
            })(jQuery);
        </script>
    <?php
    }

}