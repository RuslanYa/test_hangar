<?php

class Animal{
    public $res;
    public $num;

    public function getRes(){
        return $this->res;
    }

}
// Класс куриц
class  Chicken extends Animal{

    function __construct(){
        $this->res = rand(0,1);
    }

}
// Класс коров
class  Cow extends Animal{

    function __construct(){
        $this->res = rand(8,10);
    }

}

// Создаем класс сарая с применением Singelton
// Методы для добаления экземпляра животного
// Методы получения ресурса любого животного
// Создаем единый счетчик для регистрации в сарае $registerNum
// И массив для хранения всех животных $hangar;
class Hangar
{
    private static  $instance;
    public static $registerNum;
    public static $hangar;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public  function  addAnimal($animal){
        $animal = new $animal;
        $animal->num =  ++self::$registerNum;
        self::$hangar[] = $animal;
    }



    public  function collect($animal){
        $res = 0;

        foreach (self::$hangar as $item){
            if ($item instanceof $animal){
            $res += $item->res;
            }
        }

        return $res;
    }

}

// Создаем сарай в единственно возможном экземпляре
$r = Hangar::getInstance();

// Добавляем 10 коров
 for ($i=0; $i<=9; $i++){
     $r->addAnimal('cow');
 }
// 20 куриц
 for ($i=0; $i<=19; $i++){
     $r->addAnimal('chicken');
 }

// Собираем надой, яйца выводим на экран

echo 'Количество яиц: ';
echo $r->collect('chicken');
echo '<br>';

echo 'Литров молока: ';
echo $r->collect('cow');


?>