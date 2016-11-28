<?php
/**
 * 取图片的平均颜色
 *
 * @param $im resource 图片资源
 *
 * @return int
 */
function image_average_color($im)
{
    $r_sum = 0;
    $g_sum = 0;
    $b_sum = 0;
    $w = imagesx($im);
    $h = imagesy($im);
    for ($x = 0; $x < $w; ++$x) {
        for ($y = 0; $y < $h; ++$y) {
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xff;
            $g = ($rgb >> 8) & 0xff;
            $b = $rgb & 0xff;
            $r_sum += $r;
            $g_sum += $g;
            $b_sum += $b;
        }
    }
    $n = $w * $h;
    $r = round($r_sum / $n);
    $g = round($g_sum / $n);
    $b = round($b_sum / $n);
    return ($r << 16) | ($g << 8) | $b;
}

/**
 * @param $name string 微信大屏幕名称
 *
 * @return array 头像网址、昵称组成的数组
 */
function fetch_user($name)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://p.wxscreen.com/' . $name . '/user/sync?state=message');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json, text/javascript, */*; q=0.01']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $content = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($content, true);
    $ret = [];
    if ($json) {
        foreach ($json['user_list'] as &$user) {
            $ret[] = [
                'avatar' => $user['avatar'],
                'name' => html_to_text($user['name']),
            ];
        }
    }
    return $ret;
}

/**
 * 去除html标签及多余的空白
 *
 * @param $html string 目标HTML文本
 *
 * @return string
 */
function html_to_text($html)
{
    return trim(preg_replace('/[\s\0\x0B\xC2\xA0]+/su', ' ', html_entity_decode(preg_replace('/<.*?>/su', ' ', $html))));
}