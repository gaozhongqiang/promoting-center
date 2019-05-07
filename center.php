<?php
/**
 * Created by PhpStorm.
 * User: gzq
 * Date: 2019/5/7
 * Time: 14:57
 * 推广中心配置
 */
namespace Promoting\Center;
class Center{
    public static $foreign_type = array(//海外选择字段
        -1  => array('id' => -1,    'value' => '国内',    'search' => array(-1)),
        -2  => array('id' => -2,    'value' => '海外',    'search' => array(1,2)),
        1   => array('id' => 1,     'value' => '台湾',    'search' => array(1)),
        2   => array('id' => 2,     'value' => '香港',    'search' => array(2)),
    );
    /**
     * @var array
     * 1：总管理员
     * 2：财务
     * 3：普通管理员
     * 4：推广专员
     * 5：内部推广
     * 6：推广小组长
     * 7：内部后台管理
     * 8：签约后台管理
     * 9：工作室后台管理
     * 10：网红后台管理
     */
    public static $foreign_allow_usergroup_arr = array(1,3,6);//显示的用户组

    /**
     * 获取海外下拉框
     * @param int $usergroup_id
     * @param int $selected_id
     * @return string html选择框
     */
    public static function getForeignSelectHtml($usergroup_id,$selected_id = -1){
        if(!in_array($usergroup_id,self::$foreign_allow_usergroup_arr)){
            return '';
        }
        $html = <<<EOF
        <style type="text/css">
     .dq_xz select {width: 150px;height: 60px;line-height: 60px;font-size: 20px; padding: 0 0 0 25px;border-radius: 10px;border: 1px solid #eee;background: #f2f2f2;outline: none;margin: 0 0 0 40px;}
     option {font-weight: normal;display: block;white-space: pre;min-height: 1.2em;padding: 0px 2px 1px;}   
</style>
<div class="dq_xz">
<select onchange="syn_foreign_id(this)">
EOF;
        foreach (self::$foreign_type as $key => $value){
            $selected = $key == $selected_id ? 'selected = "selected"' : '';
            $html .= "<option value='{$value['id']}' {$selected}>{$value['value']}</option>";
        }
        $html .= <<<EOF
</select></div>
<script type="text/javascript">
function syn_foreign_id(_this) {
  $("input[name='is_foreign']").val($(_this).find('option:selected').val());
}
</script>
EOF;
        return $html;
    }
}
