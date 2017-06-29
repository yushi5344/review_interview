#面向对象基础
面向对象特点：

	封装
	继承
	多态

oop概念

	类（class）
	对象（object）
	字段(filed)
	属性(attribute)
	方法(method)

构造方法：

	构造方法是一种特殊的方法，方法名同类名一致。构造方法只需要实例化完成调用过程。通过魔法方法__construct()来识别。

析构方法：

	析构方法的用途是在整个类使用完毕才执行。一般用于清理内存中对象。清理数据库数据等。

拦截器

	public function __set($key,$value){
		$this->$key=$value;
	}
	public function __get($key){
		return $this->$key
	}
	
常量：

	const PI=3.1415;

静态类关键词  

	static
 	
final关键字可以防止类被继承，还可以防止方法被继承。
##抽象类和方法
抽象方法很特殊，只在父类中声明，在子类中实现。只有声明为abstract的类才能声明抽象方法

	抽象类不能被实例化，只能被继承
	抽象方法必须被子类重写

##接口
接口定义了实现某种服务的一种规范，声明了所需的函数和常量，但不能指定如何实现，之所以不给出这些环节，是因为不同的实体可能呢需要不同的方法来实现公共的方法定义。关键是要建立必须实现的一组一般原则，只有满足了这些原则才能说实现了某个接口。

	类全部为抽象方法（不需要声明abstract）
	接口抽象方法必须是public
	成员字段必须是常量。

	interface Computer{
	    const NAME='LEE';
	    public function run();
	}

	final class NoteBook implements Computer{
	    public function run(){
	        echo '实现了接口的方法';
	    }
	}

	$note=new NoteBook();
	$note->run();


#oop魔术方法

	__autoload()   自动调用类

	__call()  屏蔽对象调用方法时产生的错误。当对象调用一个不存在的方法时，会自动调用__call()方法。

	__toString()  打印对象的引用。如果没有__toString()的对象时产生一个错误。

	__clone()当一个对象被克隆时自动执行clone方法。