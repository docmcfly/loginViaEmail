<?php
/**
 * This file is part of the "login via email" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2025 C. Gogolin <service@cylancer.net>
 *
 */

namespace Cylancer\Loginviaemail\Services;

use TYPO3\CMS\Core\Authentication\AbstractAuthenticationService;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class EMailFrontendUserAuthenticationService extends AbstractAuthenticationService
{

    protected string $email_column = 'email';

    protected array $loginData = [];

    private const SERVICE_KEY = 'Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService';

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
            if ($this->checkPassword(trim($this->login['uident']), $user[$this->pObj->userident_column])) {
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

        $userTable = $this->pObj->user_table;

        $qb = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($userTable);

        $uname = trim($this->login['uname']);
        $p_uname = $qb->createNamedParameter($uname);

        $query = $qb->select('*')->from($userTable);

        if (filter_var($uname, FILTER_VALIDATE_EMAIL)) {
            $query->where(
                $qb->expr()->or(
                    $qb->expr()->eq($this->pObj->username_column, $p_uname),
                    $qb->expr()->eq($this->email_column, $p_uname)
                )
            );
        } else {
            $query->where($qb->expr()
                ->eq($this->pObj->username_column, $p_uname));
        }

        if ($this->pObj->checkPid) {
            $query->andWhere(
                $qb->expr()->in('pid', $this->pObj->checkPid_value)
            );
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
        return GeneralUtility::makeInstance(PasswordHashFactory::class)->get($passwordHash, $this->authInfo['loginType'])->checkPassword($password, $passwordHash);
    }
}


