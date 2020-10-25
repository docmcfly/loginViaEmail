<?php
namespace Cylancer\Loginviaemail\Services;

use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
/*
 * EMailFrontendUserAuthenticationService.php
 *
 * Copyright 2020 Clemens Gogolin <service@cylancer.net>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 *
 */
class EMailFrontendUserAuthenticationService extends FrontendUserAuthentication
{

    protected $email_column = 'email';

    const SERVICE_KEY = 'Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService';
    
    /**
     * Initialize the service
     * @return boolean
     */
    function init()
    {
        return true;
    }
    
    /**
     * Returns the service key.
     * @return string
     */
    function getServiceKey()
    {
        return EMailFrontendUserAuthenticationService::SERVICE_KEY;
    }

    /**
     * Initialize the authentication
     * @param String $param
     * @return boolean
     */
    function initAuth($param)
    {
        return $param == 'getUserFE' ;
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
        return GeneralUtility::makeInstance(PasswordHashFactory::class)->get($passwordHash, $this->getLoginType())
            ->checkPassword($password, $passwordHash);
    }
}


