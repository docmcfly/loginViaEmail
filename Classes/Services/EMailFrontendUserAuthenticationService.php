<?php
/**
 * This file is part of the "login via email" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025 C. Gogolin <service@cylancer.net>
 * 
 * @package Cylancer\Loginviaemail\Services;
 */

namespace Cylancer\Loginviaemail\Services;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EMailFrontendUserAuthenticationService extends FrontendUserAuthentication
{

    protected string $email_column = 'email';

    protected array $loginData = [];

    private const SERVICE_KEY = 'Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService';

    /**
     * Initialize the service
     *
     * @return boolean
     */
    function init(): bool
    {
        return true;
    }

    /**
     * Returns the service key.
     *
     * @return string
     */
    public function getServiceKey(): string
    {
        return EMailFrontendUserAuthenticationService::SERVICE_KEY;
    }

    /**
     * Initialize the authentication
     *
     * @param string $subType
     * @param array $param
     * @param array $param
     * @return boolean
     */
    public function initAuth(string $subType, array $loginData): bool
    {
        $this->loginData = $loginData;
        return $subType == 'getUserFE';
    }

    /**
     *
     * @inheritdoc
     * 
     * @param array $user
     * @return number
     */
    public function authUser(array $user): int
    {
        if ($user == null) {
            return 150; // no auth - continue
        } else {
            if ($this->checkPassword(trim($this->loginData['uident']), $user[$this->userident_column])) {
                return 250; // successful - stop
            } else {
                return -50; // failed - stop
            }
        }
    }

    /**
     *
     * @inheritdoc
     * 
     * @return array|boolean
     */
    public function getUser(): array|bool
    {
        $uname = trim($this->loginData['uname']);

        $qb = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->user_table);
        $p_uname = $qb->createNamedParameter($uname);
        $query = $qb->select('*')->from($this->user_table);

        if (filter_var($uname, FILTER_VALIDATE_EMAIL)) {
            $query->where(
                $qb->expr()->or(
                    $qb->expr()->eq($this->username_column, $p_uname),
                    $qb->expr()->eq($this->email_column, $p_uname)
                )
            );
        } else {
            $query->where($qb->expr()
                ->eq($this->username_column, $p_uname));
        }

        $query->setMaxResults(2); //  0 : not found / 1 : found / 2 : to many found. 

        $rows = $query->executeQuery()->fetchAllAssociative();

        if (count($rows) == 1) {
            return $rows[0];
        }
        return false;
    }

    /**
     * Check the password
     * @return bool
     **/
    private function checkPassword($password, $passwordHash): bool
     {
        return GeneralUtility::makeInstance(PasswordHashFactory::class)->get($passwordHash, $this->loginType)->checkPassword($password, $passwordHash);
    }
}


