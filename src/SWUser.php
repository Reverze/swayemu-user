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
    public static $PasswordContainsDigits = true;
    /**
     * Czy haslo ma zawierac conajmniej jeden znak duzej litery
     * @var boolean
     */
    public static $PasswordContainsUppercase = true;
    /**
     * Czy haslo ma zawierac conajmniej jeden znak specjalny
     * @var boolean
     */
    public static $PasswordContainsSpecialChars = false;

    /**
     * Represents xa user
     * @var XA\PlatformClient\Controller\User\XAUser
     */
    private $xaUser = null;


    public function __construct()
    {
        if (empty($this->xaUser)){
            $this->xaUser = $this->createXAUser();
        }

        $this->fetchDataFromEnvironment();
        $this->fetchData();
    }

    /*
     * Creates a new XAUser instance
     */
    private function createXAUser() : XAUser
    {
        $xaUser = new XAUser(\SWUserCore::getUserEnvironment(), \SWUserCore::getUserGeneric());
        return $xaUser;
    }

    private function fetchDataFromEnvironment()
    {
        static::$MinimumLoginLength = \SWUserCore::getUserEnvironment()->getMinimalUserNameLength();
        static::$MaximumLoginLength = \SWUserCore::getUserEnvironment()->getMaximulUserNameLength();
        static::$MaximumPasswordLength = 30;
        static::$MinimumPasswordLength = \SWUserCore::getUserEnvironment()->getMinimalPasswordLength();
        static::$PasswordContainsDigits = \SWUserCore::getUserEnvironment()->shouldPasswordContainDigits();
    }

    private function fetchData()
    {
        /**
         * If XA user is online, fetches data from XAUser object
         */
        if ($this->xaUser->isOnline()){
            $this->current_id = $this->xaUser->getUserId();
            $this->current_nick = $this->xaUser->getUserName();
            $this->current_email = $this->xaUser->getEmail();
            $this->current_user_group = $this->xaUser->getUserGroupId();
            $this->register_ip_addr = $this->xaUser->getRegisterIpAddress();
            $this->register_time = $this->xaUser->getRegisterTime();
        }
    }


    /**
     * Checks if user is online
     * @return bool
     */
    public function IsLogged()
    {
        return $this->xaUser->isOnline();
    }

    /**
     * Ends user's session
     * @return bool
     */
    public function Logout()
    {
        return $this->xaUser->logout(true);
    }


    /**
     * Erase object
     */
    private function erase()
    {
        $this->current_id = 0;
        $this->current_email = "";
        $this->current_nick = "";
        $this->current_flags = "";
        $this->current_user_group = "";
        $this->register_time = 0;
        $this->register_ip_addr = "";
    }

    /**
     * Registers a new user
     * @param string $nick
     * @param string $password
     * @param string $email
     * @return bool|int
     */
    public function Register(string $nick, string $password, string $email)
    {
        /**
         * Creates a new user account using client
         */
        $registerUserResult = $this->xaUser->register($nick, $email, $password);

        /**
         * Username is in use by another user
         */
        if ($registerUserResult === XAUser::RESERVED_USER_NAME){
            return 2;
        }

        /**
         * Email address is assigned to another user account
         */
        if ($registerUserResult === XAUser::RESERVED_EMAIL_ADDRESS){
            return 3;
        }

        /**
         * Given user name was empty
         */
        if ($registerUserResult === XAUser::EMPTY_USERNAME){
            return 4;
        }

        /**
         * Given user password was empty
         */
        if ($registerUserResult === XAUser::EMPTY_USERPASSWORD){
            return 6;
        }

        /**
         * Given email address was invalid
         */
        if ($registerUserResult === XAUser::INVALID_EMAIL_ADDRESS){
            return 7;
        }

        /**
         * Given user name was invalid (eg. too short)
         */
        if ($registerUserResult === XAUser::INVALID_USER_NAME){
            return 8;
        }

        /**
         * Given user password was invalid (eg. to short)
         */
        if ($registerUserResult === XAUser::INVALID_PASSWORD){
            return 9;
        }

        /**
         * Unexpected error occurred while prepare confirmation code.
         * Account was created but user should resend a new confirm code.
         */
        if ($registerUserResult === XAUser::PREPARE_CONFIRMATION_FAILED){
            return 10;
        }

        if ($registerUserResult === XAUser::MAIL_SEND_FAILED){
            return 11;
        }

        if ($registerUserResult === XAUser::UNEXPECTED_ERROR){
            return false;
        }

        return $registerUserResult;
    }

    /**
     * Creates a new session for user
     * @param string $mixed
     * @param string $password
     * @return bool|int
     */
    public function Login(string $mixed, string $password)
    {
        if (!$this->xaUser->isOnline()){
            $signinResult = $this->xaUser->signin($mixed, $password);

            if ($signinResult === XAUser::INVALID_PASSWORD){
                return 3;
            }

            if ($signinResult === XAUser::USER_NOT_FOUND){
                return 2;
            }

            if ($signinResult === XAUser::OK){
                return true;
            }
        }

        return false;
    }

    /**
     * Gets XAUser object
     * @return XAUser
     */
    public function getXAUser() : XAUser
    {
        return $this->xaUser;
    }

    /**
     * [DEPRECATED] Checks if flag is assigned to user account.
     * @param string $flag
     * @return bool
     */
    public function HaveFlag(string $flag) : bool
    {
        trigger_error("Method 'HaveFlag' is deprecated! This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Appends a new user log.
     * @param string $content
     * @return bool
     */
    public function AppendLog(string $content) : bool
    {
        trigger_error("Method 'AppendLog' is deprecated! This feature will be removed soon.", E_USER_DEPRECATED);
        return true;
    }

    /**
     * Gets all user's logs.
     * @param int $limit
     * @return array
     */
    public function GetLogs(int $limit) : array
    {
        trigger_error("Method 'GetLogs' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return array();
    }

    /**
     * Sets user's avatar.
     * @param string $uri
     * @return bool
     */
    public function SetAvatar(string $uri) : bool
    {
        trigger_error("Method 'SetAvatar' is not available yet.", E_USER_NOTICE);
        return false;
    }

    /**
     * Sets user's firstname.
     * @param string $firstname
     * @return bool
     */
    public function SetFirstname(string $firstname) : bool
    {
        trigger_error("Method 'SetFirstname' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's lastname.
     * @param $lastname
     * @return bool
     */
    public function SetLastname(string $lastname) : bool
    {
        trigger_error("Method 'SetLastname' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's city.
     * @param string $city
     * @return bool
     */
    public function SetCity(string $city) : bool
    {
        trigger_error("Method 'SetCity' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets profile's description.
     * @param string $desc
     * @return bool
     */
    public function SetDescription(string $desc) : bool
    {
        trigger_error("Method 'SetDescription' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's birthday
     * @param $birthday
     * @return bool
     */
    public function SetBirthday($birthday) : bool
    {
        trigger_error("Method 'SetBirthday' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's GG.
     * @param $gg
     * @return bool
     */
    public function SetGG($gg) : bool
    {
        trigger_error("Method 'SetGG' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's gender.
     * @param $sex
     * @return bool
     */
    public function SetSex($sex) : bool
    {
        trigger_error("Method 'SetSex' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Sets user's nickname.
     * @param string $nick
     * @return bool
     */
    public function SetNick(string $nick) : bool
    {
        trigger_error("Method 'SetNick' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Verifies user password
     * @param string $password
     * @return bool
     */
    public function CheckPassword(string $password) : bool
    {
        $checkResult = $this->xaUser->verifyUserPassword($password);

        if (is_bool($checkResult)){
            return $checkResult;
        }
        else{
            return false;
        }
    }

    /**
     * Creates a hash from given password.
     * @param string $password
     * @return string
     */
    public function PasswordHash(string $password) : string
    {
        trigger_error("Method 'PasswordHash' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return "";
    }

    /**
     * Changes current user's password.
     * @param string $newPassword
     * @param string $currentPassword
     * @return bool
     */
    public function ChangePassword(string $newPassword, string $currentPassword) : bool
    {
        trigger_error("Method 'ChangePassword' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Changes email address assigned to user's account.
     * @param string $newEmailAddress
     * @return bool
     */
    public function ChangeEmail(string $newEmailAddress) : bool
    {
        trigger_error("Method 'ChangeEmail' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * @param $type
     * @return bool
     */
    public function AppendLoginStatus($type) : bool
    {
        trigger_error("Method 'AppendLoginStatus' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return true;
    }

    /**
     * Gets all unread notifications
     * @return array
     */
    public function GetUnReadNotification() : array
    {
        trigger_error("Method 'GetUnReadNotification' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return array();
    }

    /**
     * @param int $userID
     * @return bool
     */
    public function OnFriendsList(int $userID) : bool
    {
        trigger_error("Method 'OnFriendsList' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Refreshes user object
     */
    public function Refresh()
    {
        trigger_error("Method 'Refresh' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
    }

    /**
     * Checks if user has admin roles.
     * @return bool
     */
    public function IsAdmin() : bool
    {
        trigger_error("Method 'IsAdmin' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }

    /**
     * Checks if multi session is enabled for user account.
     * @return bool
     */
    public function isMultiSessionEnabled() : bool
    {
        trigger_error("Feature 'MultiSession' is not available now. Learn more about feature called XA Cross Domain Session.", E_USER_DEPRECATED);
        return false;
    }

    public function setMultiSessionEnabledState(bool $state) : bool
    {
        trigger_error("Method 'setMultiSessionEnabledState' is deprecated. This feature will be removed soon.", E_USER_DEPRECATED);
        return false;
    }
}

?>