<?

/**
 * php 缩略图服务,中转服务,防盗链破解
 * 可用于破解盗链,当然是消耗服务器宽带资源的
 * 使用说明 $_GET['img'] 图片资源的地址,可以是防盗链的地址
 * $_GET['local'] 是否本地化,即缓存此图片,默认为是,如指定参数则不缓存
 * $_GET['w'] 缩略图的宽,宽和高指定一个另一个会自动补全(保持宽高比不变)
 * $_GET['h'] 缩略图的高,宽和高也可以采用百分比参数 ,如 w=0.8 将会变为80% 
 * 若不指定 宽高,则将不会缩略而只是本地化,或者中转,若是本地化,也会本地化缩略图.
 * 宽和高若设定超过原图,则按原图最大尺寸算.
 * PHP需支持GD库
 *  @package        spic
 * 	@link  			http://blog.suconghou.cn
 *	@author 		suconghou
 *	@copyright 		2013 Suconghou
 *  @version        1.0 bulid131009
 */

class spic
{

/**
 *	@param 	string 	 	$img  	图片的连接地址
 *	@param 	string 		$w    	最终计算出来的缩略图的宽
 *	@param  string 		$h 		最终计算出来的缩略图的高
 *	@param  string  	$q 		图片的质量,仅用于jpg,默认为80
 * 	@param  string  	$local  是否本地化,不指定为是
 *  @param  string 		$hash   鉴别缓存的hash,用于缓存
 */
	public $img;
	public $w;
	public $h;
	public $q;
	public $local;

	public $hash;



	function __construct()
	{

		error_reporting(0);
		$this-> img =isset($_GET['img'])?$_GET['img']:exit('no input img url');
		$this -> w =isset($_GET['w'])?$_GET['w']:null;
		$this -> h =isset($_GET['h'])?$_GET['h']:null;
		$this -> q =isset($_GET['q'])?$_GET['q']:'80';///质量默认为80
		$this -> local=isset($_GET['local'])?$_GET['local']:null;

		

	}



	function show()
	{
		$img=getimagesize($this-> img);
		$img_w=$img[0];
		$img_h=$img[1];



		if ($this-> w && $this-> h) ///宽高都声明
		{
			if ($this-> w <1)  ///宽 是百分比
			{
				$this-> w=$this-> w * $img_w;
			}
			else ///不是百分比
			{
				$this-> w=($this-> w >$img_w)?$img_w:$this-> w;

			}
			if ($this-> h <1)  ///高 是百分比
			{
				$this-> h=$this-> h * $img_h;
			}
			else
			{
				$this-> h=($this-> h >$img_h)?$img_h:$this-> h;

			}
			
		}
		else if ($this-> w)//仅仅指定宽
		{
			
			if ($this-> w <1) ///百分比
			{
				$this-> h=$this-> w * $img_h;
				$this-> w=$this-> w * $img_w;
				
			}
			
			else if ($this-> w< $img_w) ///不是百分比 ,参数小于实际宽度
			{
				///宽度保持指定的参数,高度计算百分比
				$this-> h=$img_h * ($this-> w / $img_w);


				
			}
			
			else  ///参数大于实际宽度,保持原图
			{
				$this-> w=$img_w;
				$this-> h=$img_h;

			}
		
		}
		else if ($this-> h) //仅仅指定高
		{
			if ($this-> h <1) ///百分比
			{
				$this-> w=$this-> h * $img_w;
				$this-> h=$this-> h * $img_h;
			}
			
			else if ($this-> h< $img_w) ///不是百分比 ,参数小于实际高度
			{
				$this-> w=$img_w * ($this-> h / $img_h);
				//高度 保持保持指定的参数


				
			}
			
			else  ///参数大于实际宽度,保持原图
			{
				$this-> w=$img_w;
				$this-> h=$img_h;

			}

		}
		else ///宽和 高 都没有指定,保持原图
		{

				$this-> w=$img_w;
				$this-> h=$img_h;

		}

		$hash=md5($this-> img . $this-> w . $this-> h);
		$dir=substr($hash,0,1);
		$this-> hash='./'.$dir.'/'.$hash.'.jpg';

		/*echo '原图:',$img_w,' ',$img_h,'<br>';
		echo $this-> w,' ',$this-> h,' ',$this-> hash;
		print_r($img);*/

		
		$this->readcache();///自动检测缓存

		
		$new_img= @imagecreatetruecolor($this-> w, $this-> h);

		if ($img[2]==1)  ///gif
		{
			 $src_image=imagecreatefromgif($this-> img);
		}
		else if ($img[2]==2) ///jpg
		{
			 $src_image=imagecreatefromjpeg($this-> img);
		}
		else //png
		{
			$src_image=imagecreatefrompng($this-> img);
		}



		imagecopyresampled($new_img,$src_image,0,0,0,0,$this-> w,$this-> h,$img_w,$img_h);


				if ($img[2]==1)  ///gif
				{
					if ($this-> local)
					{
						
						header('Content-Type: image/gif');
						imagegif($new_img);
					}
					else //缓存
					{
						is_dir($dir)||mkdir($dir);
						imagegif($new_img,$this-> hash);
						$this-> readcache();

					}
					 
				}
				else if ($img[2]==2) ///jpg,支持质量选择
				{
					if ($this-> local)
					{
						
						header('Content-Type: image/jpeg');
						imagejpeg($new_img,null,$this-> q);
					}
					else//缓存
					{
						is_dir($dir)||mkdir($dir);
						imagejpeg($new_img,$this-> hash,$this-> q);
						$this-> readcache();

					}
				}
				else //png
				{
					if ($this-> local)
					{
						
						header('Content-Type: image/png');
						imagepng($new_img);
					}
					else
					{
						is_dir($dir)||mkdir($dir);
						imagepng($new_img,$this-> hash);
						$this-> readcache();


					}
				}
			
		
				imagedestroy($new_img);
				imagedestroy($src_image);
				exit();



		
	}



	

	public function readcache()
	{
		$path=$this-> hash;
		if(is_file($path))
		{

			header('Content-Type: image/jpeg');
			
			header("location:{$path}");
			exit();
		}

		
	}





} 
////end of class spic


////a simple example////
$spic=new spic();
$spic->show();


?>