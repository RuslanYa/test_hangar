<?php
// Класс куриц
class  Chicken {

    private $eggs;
    public $num;

    function __construct(){
        $this->eggs = rand(0,1);
    }

    public function getEggs(){
        return $this->eggs;
    }
}
// Класс коров
class  Cow {

    private $milk;
    public $num;

    function __construct(){
        $this->milk = rand(8,10);
    }

    public function getMilk(){
        return $this->milk;
    }
}

// Создаем класс сарая с применением Singelton
// Методы для добаления коровы и курицы
// Методы получения всех яиц от всех куриц и молока от всех коров
// Создаем единый счетчик для регистрации в сарае $registerNum
// И два массива с курами и кровами
class Hangar
{
    private static  $instance;
    public static $registerNum;
    public static $cows;
    public static $chickens;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

   
    public static function addCow(){

        $cow = new Cow();
        $cow->num =  ++self::$registerNum;
        self::$cows[] = $cow;
    }

    public static function addChicken(){

        $chicken = new Chicken();
        $chicken->num = ++self::$registerNum;
        self::$chickens[] = $chicken;
    }

    public static function collectEggs(){
        $allEggs = 0;
        foreach (self::$chickens as $chicken){
            $allEggs += $chicken->getEggs();
        }
        return $allEggs;
    }

    public static function collectMilk(){
        $allMilk = 0;
        foreach (self::$cows as $cow){
            $allMilk += $cow->getMilk();
        }
        return $allMilk;
    }



}

// Создаем сарай в единственно возможном экземпляре
$r = Hangar::getInstance();

// Добавляем 10 коров
 for ($i=0; $i<=9; $i++){
     $r::addCow();
 }
// 20 куриц
 for ($i=0; $i<=19; $i++){
     $r::addChicken();
 }


// Собираем надой, яйца выводим на экран
echo 'Количество кур: ';
echo count($r::$chickens);
echo '<br>';
echo 'Количество яиц: ';
echo $r::collectEggs();
echo '<br>';
echo 'Количество коров: ';
echo count($r::$cows);
echo '<br>';
echo 'Литров молока: ';
echo $r::collectMilk();


?>