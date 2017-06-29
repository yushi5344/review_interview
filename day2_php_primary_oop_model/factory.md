# 工厂模式 #
什么是工厂模式

	工厂模式 是一种类，它具有为您创建对象的某些方法。您可以使用工厂类创建对象，而不直接使用 new。这样，如果您想要更改所创建的对象类型，只需更改该工厂即可。使用该工厂的所有代码会自动更改。

在factory.php页面

	include 'Jpeg.class.php';
	include 'Gif.class.php';
	include 'Png.class.php';
	include 'Factory.class.php';
	$factory=new Factory();
	$a=$factory::getImage('./img/1.jpg');
	$a->getHeight();

Jpeg.class.php页面代码

	class Jpeg{
    	public function getWidth(){
        	echo 'jepg宽度';
    	}
	    public function getHeight(){
	        echo 'jpeg高度';
	    }
	}

Gif.class.php页面代码

	class Gif{
	    public function getWidth(){
	        echo 'gif宽度';
	    }
	    public function getHeight(){
	        echo 'gif高度';
	    }
	}

Png.class.php页面代码

	class Png{
	    public function getWidth(){
	        echo 'png宽度';
	    }
	    public function getHeight(){
	        echo 'png高度';
	    }
	}

Factory.class.php

	class Factory{
	    static public function getImage($_path){
	        $_file=pathinfo($_path);
	        switch ($_file['extension']){
	            case 'png':
	                return new Png();
	                break;
	            case 'jpg':
	                return new Jpeg();
	                break;
	            case 'gif':
	                return new Gif();
	                break;
	        }
	    }
	}