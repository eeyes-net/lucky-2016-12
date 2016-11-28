<?php
namespace app\index\controller;

use app\index\model\Screen;
use think\captcha\Captcha;
use think\Config;
use think\Controller;
use think\Image;
use think\Request;
use think\Url;

class Index extends Controller
{
    /**
     * 直接返回主页
     *
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 上传背景图片，创建新的抽奖页面，并跳转到该页面
     */
    public function createScreen()
    {
        // 获取上传的背景图
        $file = Request::instance()->file('image');
        if (!$file) {
            $this->error('必须上传背景图');
            return;
        }
        $info = $file->move(Config::get('image_upload_dir'), date('Ym') . '/' . $file->md5());
        if (!$info) {
            $this->error('上传背景图片失败');
            return;
        }
        $bg = $info->getSaveName();

        // 计算平均颜色
        switch ($info->getExtension()) {
            case 'jpg':
                $im = imagecreatefromjpeg($info->getRealPath());
                break;
            case 'png':
                $im = imagecreatefrompng($info->getRealPath());
                break;
            case 'gif':
                $im = imagecreatefromgif($info->getRealPath());
                break;
            default:
                $this->error('同学，不要乱搞啊...', Url::build('index/index/index'));
                return;
        }
        $color = image_average_color($im);
        imagedestroy($im);

        Image::open($info->getRealPath())->water(APP_PATH . '../public/images/eeyes_mark.png', Image::WATER_SOUTHEAST, 50)->save($info->getRealPath());

        // 获取用户填写的抽奖页面的标题
        $title = Request::instance()->post('title', '微信大屏幕抽奖', 'htmlspecialchars');

        // 获取用户填写的微信大屏幕的网址
        $url = Request::instance()->post('url');
        if (1 === preg_match('/^(http:\\/\\/)?p.wxscreen.com\\/([A-Za-z0-9_-]+?)\\//', $url, $matches)) {
            $name = $matches[2];
        } else {
            $this->error('微信大屏幕网址必须以http://p.wxscreen.com/开头，并且不能含有特殊字符');
            return;
        }

        // 保存数据
        $Screen = new Screen();
        $Screen->createScreen($name, $title, $bg, $color);

        // 跳转到抽奖页面
        $this->redirect(Url::build('index/index/screen', [
            'name' => $name,
        ]));
        return;
    }

    /**
     * 查看抽奖页面
     *
     * @param string $name 微信大屏幕名称
     *
     * @return mixed
     */
    public function screen($name = '')
    {
        if (!$name) {
            $this->error('同学，不要乱搞啊...', Url::build('index/index/index'));
        }
        $Screen = new Screen();
        $screen = $Screen->getScreen($name);
        if (!$screen) {
            $this->error('同学，不要乱搞啊...此抽奖页面不存在，请从主页新建一个抽奖页面', Url::build('index/index/index'));
        }
        $this->assign('bg', $screen['bg']);
        $this->assign('title', $screen['title']);
        $color = $screen['color'];
        $this->assign('color', [
            'r' => ($color >> 16) & 0xff,
            'g' => ($color >> 8) & 0xff,
            'b' => ($color) & 0xff,
        ]);
        $this->assign('user', fetch_user($name));
        return $this->fetch();
    }
}
