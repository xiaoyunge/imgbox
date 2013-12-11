
<html>
<head>
	<h1>php 缩略图服务,中转服务,防盗链破解</h1>
</head>
<body>

<h2>使用说明</h2>
<ol>

<li>程序提供五个可控制参数.使用get参数img提供图片的原始地址,w代表想要的宽度,h代表想要的高度,q代表图片质量(即压缩,此参数只支持jpg的图片),local为是否本地化(缓存),默认为是,如果有值,则不会本地化.</li>

<li>所有参数中img必须,其余可省略,如没有w和h参数,程序将输出原图(或压缩图片根据参数q而定),同时进行本地化(没有设置local的情况下),这就相当于图片中转,可以用来破解图片防盗链.</li>

<li>w和h参数可以使用百分比,参数是小于1的小数.此时图片会按照百分比缩放原图.w和h,可以只设置一个,另一个会按同比例自动补全,若是两个同时设置,注意图片长宽比可能会发生改变.</li>

<li>w和h可以使用像素,当设定的值大于原图时会使用原图的值.使用时指定一个另一个会按照同比例自动补全,若是两个同时设置,可能会改变长宽比.</li>

<li>缓存使用hash机制,利用参数img和w和h三个参数确定一个资源,也就是说对于已经被缓存过的图片,参数q无效,图片质量保持上次缓存时的图片质量.</li>

<li>缓存会以a-z 0-9新建目录存放缓存文件,因此工作目录需要写权限.缓存图片都以jpg结尾,但图片实际编码是按照原图的编码格式的.</li>

<li>因用到画图函数,php需支持GD库.</li>

<li>如果你有特殊要求,可以把img参数加密,接受参数后再解密,可以防止别人滥用资源.或者使用来访的refer做限制</li>


</ol>

<h2>程序演示</h2>
<ul>
<li>
<a href="http://su.ap01.aws.af.cm/pic/index.php">http://su.ap01.aws.af.cm/pic/index.php</a>
</li>
</ul>

<h2>联系</h2>
<ul>
<li>我的博客 <a href="http://suconghou.cn">http://suconghou.cn</a></li>

<li>我的邮箱 suconghou@126.com</li>
</ul>

</body>
</html>

