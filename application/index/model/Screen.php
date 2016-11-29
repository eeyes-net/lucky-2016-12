<?php
namespace app\index\model;

use think\Model;

class Screen extends Model
{
    /**
     * 创建抽奖页面
     *
     * @param string $name 微信墙名称
     * @param string $title 页面标题
     * @param string $bg 背景图片路径
     * @param int $color 平均颜色
     * @param string $ip ip地址
     *
     * @return false|int 成功返回id，失败返回false
     */
    public function createScreen($name, $title, $bg, $color, $ip)
    {
        $data = [
            'name' => $name,
            'title' => $title,
            'bg' => $bg,
            'color' => $color,
            'ip' => $ip,
        ];
        // wxscreen作为演示用不可覆盖
        if ($name == 'wxscreen') {
            return false;
        }
        return $this->save($data);
    }

    /**
     * 获取抽奖页面信息
     *
     * @param string $name 微信墙名称
     *
     * @return array|false|\PDOStatement|string|Model
     */
    public function getScreen($name)
    {
        return $this->where('name', $name)->order('id', 'desc')->find();
    }
}