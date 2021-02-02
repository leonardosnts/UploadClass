<?php

//echo 'ola php';

//include 'SiteInfo.php';

require __DIR__ . '/vendor/autoload.php';

use App\Config\SiteInfo;
use App\Util\Util;

function showName($value)
{
    return "Nome:$value";
}

//echo showName('Leonardo');

interface IUser 
{
    public function updatePassword(string $value);
    public function getName();
    public function getCellphone();
}

abstract class User implements IUser
{
    public $id;
    public $name;
    public $email;
    public $cellphone;
    //private $password;
    protected $password;

    public function updatePassword(string $value)
    {
        $this->password = md5($value);
    }

    abstract public function getName();

    public function getCellphone()
    {
        return $this->cellphone;
    }    

}

class Admin extends User implements IUser
{
    public function setPassword($value)
    {
        $value = $value.$this->email;
        // User::updatePassword($value);
        parent::updatePassword($value);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Manager extends User implements IUser
{
    public function getName()
    {
        return $this->name;
    }
}

class Gerente extends User implements IUser
{
    public function getName()
    {
        return $this->name;
    }
}

class Salesman extends User implements IUser
{
    public function getName()
    {
        return $this->name;
    }
}

class Client extends User implements IUser
{   
    public $subscriber;

    public function showName()
    {
        return "Nome: ".$this->name;
    }

    public function getName()
    {
        return $this->name;
    }

}

class Signature
{
    private $id;
    private $idClient;
    private $title;
    private $value;

    public function __construct(
        int $id = null, 
        int $idClient = null,
        string $title = null,
        float $value = null 
    )
    {
        $this->id = $id;
        $this->idClient = $idClient;
        $this->title = $title;
        $this->value = $value;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdClient($value)
    {
        $this->idClient = $value;
    }

    public function getIdCliente()
    {
        return $this->idClient;
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function show()
    {
        $html = "<p>";
        $html .= "<b>Id: $this->id</b>";
        $html .= "<p>";

        $html .= "<p>";
        $html .= "<b>Id do cliente: $this->idClient</b>";
        $html .= "<p>";

        $html .= "<p>";
        $html .= "<b>Assinatura: $this->title</b>";
        $html .= "<p>";

        $html .= "<p>";
        $html .= "<b>Valor: </b>".Util::formatValue($this->value);
        $html .= "<p>";

        echo $html;

    }

}

$client = new Client();
$client->id = 1;
$client->name = 'Maria';
$client->email = 'maria123@gmail.com';
//$client->password = '12345';
$client->updatePassword('54321');
$client->cellphone = '12345678';
$client->subscriber = true;

$signature = new Signature(1, $client->id, 'Diamont', 109.9);

$admin = new Admin();
$admin->id = 1;
$admin->name = 'Beatriz';
$admin->email = 'beatriz@gmail.com';
$admin->cellphone = '12345678';
$admin->setPassword('admin@321');
// echo "Senha: {$admin->getPassword()}";

// $signature = new Signature();
// $signature->setId(1);
// $signature->setIdClient($client->id);
// $signature->setTitle('Gold');
// $signature->setValue(79.9);

//echo $client->showN   ame();
//var_dump($client, $signature);
var_dump($admin, $signature);
$signature->show();

$salesman = new Salesman();
$salesman->id = 1;
$salesman->name = 'Pierre';
$salesman->email = 'Pierre@gmail.com';
$salesman->cellphone = '12345678';


echo "Nome do site: ". SiteInfo::$name;
