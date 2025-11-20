<?php
//Карты: Silver-10%, Gold-15%, Black-20%
$db = [
    'Silver' => '10%'
];

interface Cards{

    public function getGoal();//при достижении 100к-200-300к считаем и обновляем $status;
}

interface Order{

    public function getCardProcent($status);
    public function setProgressToGoal($user, $orderSum);
}

interface Users {

    public function getProgressToChangeStatus($orderSum, $status);
    public function orderSum(); //общая сумма покупок;
}

class Card implements Cards{

    private Users $user;

    public function __construct(Users $user) {
        $this->user = $user;
    }

    public function getGoal ()
    {

        $user_card = match (true){
            $this->user->orderSum() >= 300000 => ['Black' =>'20%'],
            $this->user->orderSum() >= 200000 => ['Gold' => '15%'],
            $this->user->orderSum() >= 100000 => ['Silver'=>'10%'],
            default => ['Пусто' => '0%']
        };

        return $user_card;
        
        // unset($db);
        // $db[$user_card.] = $user_card;
        // print_r($db);

    }
}

class UserCardService implements Users{

    private $orderSum = 250000;

    public function getProgressToChangeStatus($orderSum, $status){
        return;
    }

    public function orderSum(){
        return $this->orderSum;
    }
}

class User {

    private $id;
    private $phone;
    private $email;

    public function  __construct(){
    }
}

$userCardService = new UserCardService();
$userCard = new Card($userCardService);
$user_card = $userCard->getGoal();
print_r($user_card);