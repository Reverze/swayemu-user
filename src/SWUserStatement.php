<?php

use XA\PlatformClient\Controller\User\XAUserVirtual;

class SWUserStatement
{
    private static $deprecatedMessage  = "Method '%s' is deprecated. This feature will be removed soon.";

    public static function PasswordHash($password) : string
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'PasswordHash'), E_USER_DEPRECATED);
        return "";
    }

    public static function CheckPassword($password, $hash) : bool
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'CheckPassword'), E_USER_DEPRECATED);
        return false;
    }

    /**
     * Checks is username is reserved.
     * @param $nick
     * @return bool|int
     */
    public static function NickInUsing($nick)
    {
        return !\SWUserCore::getUserGeneric()->isUserNameAvailable($nick);
    }

    /**
     * Checks if email address is reserved.
     * @param $email
     * @return bool|int
     */
    public static function EmailInUsing($email)
    {
        return !\SWUserCore::getUserGeneric()->isEmailAddressAvailable($email);
    }

    public static function KeylogInUsing($keylog) : bool
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'KeylogInUsing'), E_USER_DEPRECATED);
        return false;
    }

    /**
     * Checks if user account is exists
     * @param $uid
     * @return bool|int
     */
    public static function IsUserExists($uid)
    {
        return \SWUserCore::getUserGeneric()->isUserExistsByUserId($uid);
    }

    public static function SaltInUsing($salt) : bool
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SaltInUsing'), E_USER_DEPRECATED);
        return false;
    }


    public static function GenerateSalt($length = 12) : string
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GenerateSalt'), E_USER_DEPRECATED);
        return "";
    }


    public static function GenerateKeylog($length = 32) : string
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GenerateKeylog'), E_USER_DEPRECATED);
        return "";
    }

    public static function GetSalt($email)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetSalt'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetSaltByNickname($nickname)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetSaltByNickname'), E_USER_DEPRECATED);
        return false;
    }


    public static function GetSaltById($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetSaltById'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetPassword($email)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetPassword'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetPasswordByNickname($nickname)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetPasswordByNickname'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetPasswordById($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetPasswordById'), E_USER_DEPRECATED);
        return false;
    }

    /**
     * Gets user ID.
     * @param $nickname
     * @return bool|int
     */
    public static function GetUserIDByNick(string $nickname)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserName($nickname);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getUserID();
    }

    /**
     * Gets user ID.
     * @param string $email
     * @return bool|string
     */
    public static function GetUserIDByEmail(string $email)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByEmailAddress($email);

        if (!$virtualUser instanceof  XAUserVirtual){
            return false;
        }

        return $virtualUser->getEmailAddress();
    }

    /**
     * Gets user name.
     * @param int $userID
     * @return bool|string
     */
    public static function GetNickById(int $userID)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserId($userID);

        if (!$virtualUser instanceof  XAUserVirtual){
            return false;
        }

        return $virtualUser->getUserName();
    }

    /**
     * Gets user ID.
     * @param $email
     * @return bool|string
     */
    public static function GetIDByEmail(string $email)
    {
        return self::GetUserIDByEmail($email);
    }

    /**
     * Gets username
     * @param string $email
     * @return bool|string
     */
    public static function GetNickByEmail(string $email)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByEmailAddress($email);

        if (!$virtualUser instanceof  XAUserVirtual){
            return false;
        }

        return $virtualUser->getUserName();
    }

    /**
     * Gets email address assigned to user account.
     * @param int $userID
     * @return bool|string
     */
    public static function GetEmailById(int $userID)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserId($userID);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getEmailAddress();
    }

    /**
     * Gets email address assigned to user account.
     * @param string $nick
     * @return bool|string
     */
    public static function GetEmailByNick(string $nick)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserName($nick);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getEmailAddress();
    }

    /**
     * Gets user register timestamp.
     * @param string $nick
     * @return bool|int
     */
    public static function GetRegisterTimeByNick(string $nick)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserName($nick);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getRegisterTimestamp();
    }

    /**
     * Gets user register timestamp
     * @param int $userID
     * @return bool|int
     */
    public static function GetRegisterTimeById(int $userID)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserId($userID);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getRegisterTimestamp();
    }

    /**
     * Gets user register ip address.
     * @param string $nick
     * @return bool|string
     */
    public static function GetRegisterIpAddressByNick(string $nick)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserName($nick);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getRegisterIpAddress();
    }

    /**
     * Gets user register ip address.
     * @param int $userID
     * @return bool|string
     */
    public static function GetRegisterIpAddressById(int $userID)
    {
        $virtualUser = \SWUserCore::getUserGeneric()->getUserObjectByUserId($userID);

        if (!$virtualUser instanceof XAUserVirtual){
            return false;
        }

        return $virtualUser->getRegisterIpAddress();
    }

    public static function GetRecommendedPlayerById(int $userID) : array
    {
        trigger_error("This feature is not available yet.", E_USER_NOTICE);
        return array();
    }

    /**
     * Sprawdza czy format hasla jest prawidlowy
     * Konfiguracja formatu hasla jest pobierana z pol statycznych klasy SWUser
     *
     * Kody bledow:
     * 2 - haslo jest zbyt krotkie
     * 3 - haslo jest zbyt dlugie
     * 4 - haslo nie zawiera conajmniej jednej cyfry
     * 5 - haslo nie zawiera conajmniej jednej duzej litery
     * 6 - haslo nie zawiera conajmniej jednego znaku specjalnego
     *
     * @param type $password Haslo przeznaczone do sprawdzenia
     * @return int|boolean Zwraca kody bledow lub true
     */
    public static function CheckPasswordFormat($password)
    {

        //sprawdzanie dlugosci lancucha
        if (strlen($password) < SWUser::$MinimumPasswordLength)
            return 2;

        if (strlen($password) > SWUser::$MaximumPasswordLength)
            return 3;

        //haslo musi zawierac conajmniej jedna mala lub duza litere z alfabetu
        if (!preg_match('/[a-z]+|[A-Z]+/', $password))
            return 7;

        /*Jesli haslo musi posiadac conajmniej znak jednej cyfry, sprawdzany jest warunek
         * czy owe haslo posiada conajmniej znak jednej cyfry
         *
         */
        if (SWUser::$PasswordContainsDigits)
        {
            if (!preg_match('/[0-9]+/', $password))
                return 4;
        }

        /*
         * Jesli haslo musi posiadac znak conajmniej jednej dużej litery, sprawdzany jest warunek
         * czy owe haslo posiada conajmniej znak jednej duzej litery
         */

        if (SWUser::$PasswordContainsUppercase)
        {
            if (!preg_match('/[A-Z]+/', $password))
                return 5;
        }

        /*
         * Jesli haslo musi zawierac conajmniej jeden znak specjalny, sprawdzsany jest
         * warunek czy owe haslo zawiera conajmniej jeden znak specjalny
         */
        if (SWUser::$PasswordContainsSpecialChars)
        {
            if (!preg_match('/[^a-zA-Z0-9]+/', $password))
                return 6;
        }

        return true;
    }

    /**
     * Sprawdza czy nick uzytkownika ma poprawny format.
     * Konfiguracja formatu nicku jest pobierana z pol statycznych klasy SWUser
     *
     * Kody bledow
     * 2 - nick jest zbyt krotki
     * 3 - nick jest zbyt dlugi
     * 4 - nick uzytkownika nie posiada znakow z alfabetu
     * 5 - ilosc znakow cyfr w nicku jest wieksza od ilosc znakow alfabetu
     * 6 - nick posiada znaki specjalne
     *
     * @param type $nick Nick przeznaczony do sprawdzenia
     * @return int|boolean Zwraca kody bledow lub true w przypadku poprawnego formatu nicku
     */
    public static function CheckNickFormat($nick)
    {
        //Sprawdzanie dlugosci
        if (strlen($nick) < SWUser::$MinimumLoginLength)
            return 2;

        if (strlen($nick) > SWUser::$MaximumLoginLength)
            return 3;

        /* Sprawdzanie czy nick uzytkownika posiada znaki z alfabetu
         * Nie musi koniecznie posiadac cyfr
         */

        if (!preg_match('/[a-z]+|[A-Z]+/', $nick))
            return 4;

        /* Nick użytkownika powinnien zawierać więcej liter z alfabetu niz cyfr
         * Konrad21 - prawidlowy
         * Konrad2321231 - nieprawidlowy
         */
        $number_of_digits = preg_match_all('/[0-9]/', $nick);
        $number_of_letters = preg_match_all('/[a-zA-Z]/', $nick);

        if ($number_of_digits > $number_of_letters)
            return 5;

        /* Sprawdzanie czy nick posiada znaki z poza alfabetu czy zestawu cyfr
         * np (*, ;). Nicki z takimi znakami wygladaja po prostu nie estytycznie
         * Znak spacji jest pomijany
         *
         * Do zastosowania są możliwe tylko znaki z alfabetu łacińskiego i polskie znaki diakrytyczne
         */
        if (preg_match('/[^a-zA-Z0-9 ąęśćżźółńĄŻŚŹĆĘÓŁŃ]/', $nick))
            return 6;


        return true;
    }

    public static function ChangeUserPassword($user_id, $current_password, $new_password, $check_old_password = true)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ChangeUserPassword'), E_USER_DEPRECATED);
        return false;
    }


    public static function setUserSaltRandom(int $userID)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setUserSaltRandom'), E_USER_DEPRECATED);
        return false;
    }


    public static function setUserPassword(int $userID, string $rawPassword)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setUserPassword'), E_USER_DEPRECATED);
        return false;
    }


    public static function ChangeUserEmail($user_id, $new_email)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ChangeUserEmail'), E_USER_DEPRECATED);
        return false;
    }

    public static function ChangeUserNick($user_id, $new_nick)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ChangeUserNick'), E_USER_DEPRECATED);
        return false;
    }

    public static function ChangeUserGroup($user_id, $group)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ChangeUserGroup'), E_USER_DEPRECATED);
        return false;
    }

    public static function ChangeUserFlags($user_id, $flags)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ChangeUserFlags'), E_USER_DEPRECATED);
        return false;
    }

    public static function AppendUserLog($user_id, $content)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'AppendUserLog'), E_USER_DEPRECATED);
        return true;
    }

    public static function AppendAdminLog($user_id, $content)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'AppendAdminLog'), E_USER_DEPRECATED);
        return true;
    }

    public static function GetAllAdminLogs()
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetAllAdminLogs'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetAdminLogs($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetAdminLogs'), E_USER_DEPRECATED);
        return array();
    }

    public static function IsBanned(int $userID)
    {
        trigger_error("This feature is not available yet.", E_USER_NOTICE);
        return false;
    }

    public static function AppendBan($user_id, $author_id, $life_time, $reason, $type)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'AppendBan'), E_USER_DEPRECATED);
        return false;
    }

    public static function deleteBan($banID)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'deleteBan'), E_USER_DEPRECATED);
        return false;
    }

    public static function UpdateBan($ban_id, $ban_properties = array())
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'UpdateBan'), E_USER_DEPRECATED);
        return false;
    }


    public static function GetGroups()
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetGroups'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetGroupInfo($group_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetGroupInfo'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetUserProfile($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserProfile'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetUserFlags($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserFlags'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetUserLogs($user_id, $limit = 30)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserLogs'), E_USER_DEPRECATED);
        return array();
    }

    public static function SetUserAvatar($owner_id, $avatar_uri)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserAvatar'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserFirstname($owner_id, $firstname)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserFirstname'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserLastname($owner_id, $lastname)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserLastname'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserCity($owner_id, $city)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserCity'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserDescription($owner_id, $desc)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserDescription'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserBirthday($owner_id, $birthday)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserBirthday'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserGG($owner_id, $gg)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserGG'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetUserSex($owner_id, $sex)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetUserSex'), E_USER_DEPRECATED);
        return false;
    }

    public static function AppendLoginStatus($owner_id, $type)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'AppendLoginStatus'), E_USER_DEPRECATED);
        return true;
    }

    public static function GetLoginsFromArchive($owner_id, $limit = 50)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetLoginsFromArchive'), E_USER_DEPRECATED);
        return array();
    }

    public static function IsProfileExists($owner_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'IsProfileExists'), E_USER_DEPRECATED);
        return true;
    }

    public static function CreateProfile($owner_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'CreateProfile'), E_USER_DEPRECATED);
        return false;
    }

    public static function IsUserProfileExists($owner_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'IsUserProfileExists'), E_USER_DEPRECATED);
        return true;
    }

    public static function DeleteUserProfile($owner_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'DeleteUserProfile'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetNotReadNotifications($receiver_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetNotReadNotifications'), E_USER_DEPRECATED);
        return array();
    }

    public static function SetNotificationAsRead($notification_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetNotificationAsRead'), E_USER_DEPRECATED);
        return true;
    }

    public static function SetNotificationAsNotRead($notification_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetNotificationAsNotRead'), E_USER_DEPRECATED);
        return true;
    }

    public static function AppendNotification($receiver, $message, $title = "", $module = "")
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'AppendNotification'), E_USER_DEPRECATED);
        return true;
    }

    public static function GetUserRealAge($dob, $tdate)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserRealAge'), E_USER_DEPRECATED);
        return 0;
    }

    public static function GetUserFriends($owner_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserFriends'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetAllQueriesApplyForFriends($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetAllQueriesApplyForFriends'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetAllBroadcasterFriendQueries($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetAllBroadcasterFriendQueries'), E_USER_DEPRECATED);
        return array();
    }

    public static function GetNotReadQueriesApplyForFriends($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetNotReadQueriesApplyForFriends'), E_USER_DEPRECATED);
        return array();
    }

    public static function MakeQueryForApplyFriend($broadcaster, $receiver)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'MakeQueryForApplyFriend'), E_USER_DEPRECATED);
        return false;
    }

    public static function SetQueryFriendAsRead($query_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetQueryFriendAsRead'), E_USER_DEPRECATED);
        return true;
    }

    public static function SetQueryFriendAsReject($query_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetQueryFriendAsReject'), E_USER_DEPRECATED);
        return true;
    }

    public static function SetQueryFriendAsAccept($query_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'SetQueryFriendAsAccept'), E_USER_DEPRECATED);
        return true;
    }

    public static function ApplyFriends($user_one_id, $user_two_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ApplyFriends'), E_USER_DEPRECATED);
        return false;
    }

    public static function DeleteFriends($user_one_id, $user_two_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'DeleteFriends'), E_USER_DEPRECATED);
        return false;
    }

    public static function IsOnQueryFriendList($broadcaster, $receiver)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'IsOnQueryFriendLsit'), E_USER_DEPRECATED);
        return false;
    }

    public static function CheckQueryFriend($query_id, $broadcaster, $receiver, $reject = 0, $accept = 0)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'CheckQueryFriend'), E_USER_DEPRECATED);
        return false;
    }

    /**
     * Gets url of user's avatar.
     * @param int $userID
     * @return bool|string
     */
    public static function GetUserAvatar(int $userID)
    {
        $virtualuser = \SWUserCore::getUserGeneric()->getUserObjectByUserId($userID);

        if (!$virtualuser instanceof XAUserVirtual){
            return false;
        }

        return $virtualuser->getAvatarUrl();
    }


    public static function generateConfirmCode($length = 9)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'generateConfirmCode'), E_USER_DEPRECATED);
        return false;
    }

    public static function confirmCodeInUse($confirm_code)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'confirmCodeInUse'), E_USER_DEPRECATED);
        return false;
    }

    public static function validateConfirmCode($user_id, $confirm_code)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'validateConfirmCode'), E_USER_DEPRECATED);
        return false;
    }

    public static function createConfirmCodeTask($owner_id, $code, $lifetime = 7200)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'createConfirmCodeTask'), E_USER_DEPRECATED);
        return false;
    }

    public static function setUserAsConfirmed($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setUserAsConfirmed'), E_USER_DEPRECATED);
        return false;
    }

    public static function setUserAsNotconfirmed($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setUserAsNotconfirmed'), E_USER_DEPRECATED);
        return false;
    }

    public static function changeConfirmCode($user_id, $new_code)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'changeConfirmCode'), E_USER_DEPRECATED);
        return false;
    }

    public static function isUserHasConfirmCode($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'isUserHasConfirmCode'), E_USER_DEPRECATED);
        return false;
    }

    public static function sendConfirmCodeMail($name, $to, $code)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'sendConfirmCode'), E_USER_DEPRECATED);
        return false;
    }

    public static function LoginUsingEmail($email, $password)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'LoginUsingEmail'), E_USER_DEPRECATED);
        return false;
    }

    public static function CreateAccount($nickname, $email, $password, $recommend_by = 0, $create_time = -1, $user_group_id = -1, $confirmed = false, $flags = array() )
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'CreateAccount'), E_USER_DEPRECATED);
        return false;
    }

    public static function LoginUsingNickname($nick, $password)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'LoginUsingNickname'), E_USER_DEPRECATED);
        return false;
    }

    public static function ValidateNickname($nickname)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'ValidateNickname'), E_USER_DEPRECATED);
        return false;
    }

    public static function IsUserGroupExists($user_group_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'InUserGroupExists'), E_USER_DEPRECATED);
        return false;
    }

    public static function GetUserData($user_id)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'GetUserData'), E_USER_DEPRECATED);
        return false;
    }

    public static function countAllUsers()
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'countAllUsers'), E_USER_DEPRECATED);
        return false;
    }

    public static function getUsers($limit = 0, $offset = 0, $like = "")
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'getUsers'), E_USER_DEPRECATED);
        return false;
    }


    public static function setAvatarUri(int $userID, string $avatarURL = null)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setAvatarUri'), E_USER_DEPRECATED);
        return false;
    }

    public static function setMultiSessionEnabledState(int $userID, bool $multiSessionEnabledState = false)
    {
        trigger_error(sprintf(self::$deprecatedMessage, 'setMultiSessionEnabledState'), E_USER_DEPRECATED);
        return false;
    }

}

?>
