<?php
namespace Cylancer\Loginviaemail\Services;

use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EMailFrontendUserAuthenticationService extends FrontendUserAuthentication
{

    protected $email_column = 'email';

    const SERVICE_KEY = 'Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService';

    /**
     * Initialize the service
     *
     * @return boolean
     */
    function init()
    {
        return true;
    }

    /**
     * Returns the service key.
     *
     * @return string
     */
    function getServiceKey()
    {
        return EMailFrontendUserAuthenticationService::SERVICE_KEY;
    }

    /**
     * Initialize the authentication
     *
     * @param String $param
     * @return boolean
     */
    function initAuth($param)
    {
        return $param == 'getUserFE';
    }

    /**
     *
     * @inheritdoc
     * @param array $user
     * @return number
     */
    function authUser($user)
    {
        if ($user == null) {
            return 150; // no auth - continue
        } else {
            if ($this->checkPassword(trim($this->getLoginFormData()['uident']), $user[$this->userident_column])) {
                return 250; // successful - stop
            } else {
                return - 50; // failed - stop
            }
        }
    }

    /**
     *
     * @inheritdoc
     * @return array|boolean
     */
    function getUser()
    {
        $loginData = $this->getLoginFormData();
        $uname = trim($loginData['uname']);

        $qb = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable($this->user_table);
        $p_uname = $qb->createNamedParameter($uname);
        $query = $qb->select('*')->from($this->user_table);

        if (filter_var($uname, FILTER_VALIDATE_EMAIL)) {
            $query->where($qb->expr()
                ->orX($qb->expr()
                ->eq($this->username_column, $p_uname), $qb->expr()
                ->eq($this->email_column, $p_uname)));
        } else {
            $query->where($qb->expr()
                ->eq($this->username_column, $p_uname));
        }

        $rows = $query->execute()->fetchAll();

        if (count($rows) == 1) {
            return $rows[0];
        }
        return false;
    }

    /**
     * Check the password
     *
     * @return null|string
     */
    private function checkPassword($password, $passwordHash)
    {
        return GeneralUtility::makeInstance(PasswordHashFactory::class)->get($passwordHash, $this->loginType)
            ->checkPassword($password, $passwordHash);
    }
}


