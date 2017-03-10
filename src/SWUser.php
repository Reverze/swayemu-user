<?php

use XA\PlatformClient\Controller\User\XAUser;

class SWUser
{
    /**
     * User's ID
     * @var int
     */
    public $current_id = 0;
    /**
     * User's email address
     * @var string
     */
    public $current_email = "";
    /**
     * User's nickname
     * @var string
     */
    public $current_nick = "";

    /**
     * Group's ID
     * @var string
     */
    public $current_user_group = "";
    /**
     * Flags assigned to user's account (string)
     * @var string
     */
    public $flags = "";

    /**
     * Czas pierwszej rejestracji konta uzytkownika (czas uniksowy) (domyslnie 0)
     * @var int
     */
    public $register_time = 0;
    /**
     * Adres IP na ktorym zostala przeprowadzona pierwsza rejestracji (domyslnie pusty)
     * @var string
     */
    public $register_ip_addr = "";
    /**
     * ID uzytkownika ktory jest polecajacym tego uzytkownika (domyslnie 0)
     * @var int
     */
    public $recommend_by = 0;
    /**
     * ID sesji (numer wiersza w tabelu sessions) (domyslnie 0)
     * @var int
     */
    public $session_id = "";

    /**
     * Adres URL avataru.
     * NULL jesli nie ustawiony
     * @var string
     */
    public $avatarUri = null;

    /**
     * Zmienna czy konto zostalo aktywowane
     * @var type
     */
    public $confirmed = 0;

    /**
     * Merged user's flags and group's flags.
     * @var type
     */
    public $current_flags = array();

    /**
     * Obecny profil użytkownika
     * @var array
     */
    public $current_profile = array();

    /**
     * Minimalna dlugosc nicku uzytkownika
     * @var int
     */
    public static $MinimumLoginLength = 5;
    /**
     * Maksymalna dlugosc nicku uzytkownika
     * @var int
     */
    public static $MaximumLoginLength = 20;
    /**
     * Minimalna dlugosc hasla uzytkownika
     * @var int
     */
    public static $MinimumPasswordLength = 2;
    /**
     * Maksymalna dlugosc hasla uzytkownika
     * @var int
     */
    public static $MaximumPasswordLength = 20;
    /**
     * Czy haslo ma zawierac conajmniej jeden znak cyfry
     * @var boolean
     */
    public static $PasswordContainsDigits = false;
    /**
     * Czy haslo ma zawierac conajmniej jeden znak duzej litery
     * @var boolean
     */
    public static $PasswordContainsUppercase = false;
    /**
     * Czy haslo ma zawierac conajmniej jeden znak specjalny
     * @var boolean
     */
    public static $PasswordContainsSpecialChars = false;
    /**
     * Domyslny identyfikator (ID) grupy do ktorej zostanie przypisany uzytkownik przy rejestracji
     * @var int
     */
    public static $DefaultUserGroup = 2;
    /**
     * Domyslne flagi ktore zostana przypisane uzytkownikowi przy rejestracji
     * @var array
     */
    public static $DefaultFlags = "z;";


    /**
     * @var XA\PlatformClient\Controller\User\XAUser
     */
    private $xaUser = null;


    public function __construct()
    {
        if (empty($this->xaUser)){

        }
    }






}

?>