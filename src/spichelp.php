<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>spic 演示文档 帮助文档</title>
<style>
*{padding: 0;margin: 0;}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track-piece{background-color:transparent;}
::-webkit-scrollbar-thumb{background:#494949;width:5px}
::-webkit-scrollbar-thumb:hover{background:#909090}
body{text-shadow:0 0 1px #aaa;}
a{color: #d2d2d2;text-shadow:0 0 1px #ccc;text-decoration: none;}
.part1,.part2,.part3,.part4,.part5{padding:5% 10%; }
.part0{background-color:#fff; height:20px;margin: 20px 60px;}
.part1{background-color:#27ae60; color: #fff;line-height:24px;letter-spacing:0.06em;}
.part2{background-color:#fff; }
.part3{background-color:#e8eaec; }
.part4{background-color:#fff; }
.part5{background-color:#e8eaec;}
.part6{background-color:#2d2d2d; height:60px;color: #fff;line-height:60px;text-align: center;}
li{left:60px;position: relative;}
.part1 p,.part2 p,.part3 p,.part4 p,.part5 p{text-indent:2em;margin:20px 0;}
</style>
</head>
<body>
<div class='part0'>
<p><h2>spic帮助文档</h2></p>
</div>
<div class='part1'>
<p>
1.程序提供五个可控制参数.使用get参数img提供图片的原始地址,w代表想要的宽度,h代表想要的高度,q代表图片质量(即压缩,此参数只支持jpg的图片),local为是否本地化(缓存),默认为是,如果有值,则不会本地化</li></ul>
</p><p>
2.所有参数中img必须,其余可省略如没有w和h参数,程序将输出原图(或压缩图片根据参数q而定),同时进行本地化(没有设置local的情况下),这就相当于图片中转,可以用来破解图片防盗链.
</p><p>
3.w和h参数可以使用百分比,参数是小于1的小数.此时图片会按照百分比缩放原图.w和h,可以只设置一个,另一个会按同比例自动补全,若是两个同时设置,注意图片长宽比可能会发生改变.
</p><p>
4.w和h可以使用像素,当设定的值大于原图时会使用原图的值.使用时指定一个另一个会按照同比例自动补全,若是两个同时设置,可能会改变长宽比.
</p><p>
5.缓存使用hash机制,利用参数img和w和h三个参数确定一个资源,也就是说对于已经被缓存过的图片,参数q无效,图片质量保持上次缓存时的图片质量.
</p><p>
6.缓存会以a-z 0-9新建目录存放缓存文件,因此工作目录需要写权限.缓存图片都以jpg结尾,但图片实际编码是按照原图的编码格式的.
</p><p>
7.因用到画图函数,php需支持GD库.
</p><p>
8.如果你有特殊要求,可以把img参数加密,接受参数后再解密,可以防止别人滥用资源.或者使用来访的refer做限制
</p>
<p>下载地址 <a href='http://wzw.x.gg/d.php?id=0007'>http://wzw.x.gg/d.php?id=0007</a>  demo地址  http://su.ap01.aws.af.cm/pic/spic.php</p>

</div>
<div class='part2'>
<h2>例1:规定像素的图片缩略</h2><br><br><br><br><p>以百度logo为例,实现百度logo宽变为100px</p><p>写法为 http://su.ap01.aws.af.cm/pic/spic.php?img=http://www.baidu.com/img/bdlogo.gif&w=100  指定一个参数此时高度会自动适应</p><p>你也可以指定两个参数,但可能会造成图片变形</p><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://www.baidu.com/img/bdlogo.gif&w=100&h=60</p>
</div>
<div class='part3'>
<h2>例2:使用百分比的图片缩略</h2><br><br><br><br><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://www.baidu.com/img/bdlogo.gif&w=0.7</p><p>或者h=0.7效果是一样的,但是当w和h都指定时,效果就不同了</p><p>可以百分比和像素单位混用,如 w=0.5&h=100</p>
</div>
<div class='part4'>
<h2>例3:破解图片的防盗链</h2><br><br><br><br><p>例如原图地址为http://imgsrc.baidu.com/forum/pic/item/bb10c411728b47103eecfdefc1cec3fdfd032306.jpg </p><p>来自于百度图库,不可以对外引用,可以这样</p><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://imgsrc.baidu.com/forum/pic/item/bb10c411728b47103eecfdefc1cec3fdfd032306.jpg?local=no</p><p>对于此大图片,可以加上参数q,调整其质量,以减小流量,例如</p><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://imgsrc.baidu.com/forum/pic/item/bb10c411728b47103eecfdefc1cec3fdfd032306.jpg&q=40&w=0.8&local=no</p><p>原图118k,经过40%和0.8变为52k</p><p>图片质量调整只支持jpg图片,其他类型图片会忽略此参数</p>

</div>
<div class='part5'>
<h2>例4:不使用缓存</h2><br><br><br><br><p>程序默认使用缓存,使用缓存会新建很多目录,如果你不想使用缓存,可以添加 local=no 参数</p><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://qzs.qq.com/qzone/v6/v6_config/upload/f9f1ababeb51221d1f13b173674257e3.jpg&local=no&w=0.6</p><p>缓存可以提高效率,使程序不用每次去访问原图片,即使原图片失效也不会影响缩略图</p><p>因为对于已缓存过的图片,参数q无效,所以如果你经常使用参数q,可以添加不缓存</p><p>http://su.ap01.aws.af.cm/pic/spic.php?img=http://qzs.qq.com/qzone/v6/v6_config/upload/f9f1ababeb51221d1f13b173674257e3.jpg&local=no&w=0.7&q=60</p><p>应用于网页即是普通的方式 采用 img src='' 的语法,如<br><img src='http://su.ap01.aws.af.cm/pic/spic.php?img=http://www.baidu.com/img/bdlogo.gif&w=100' alt='示例'></p>

</div>
<div class='part6'>
<p> <a href='http://blog.suconghou.cn'>我的博客</a>  <script src="http://s9.cnzz.com/stat.php?id=5691178&web_id=5691178" language="JavaScript"></script></p>
</div>

</body>
</html>