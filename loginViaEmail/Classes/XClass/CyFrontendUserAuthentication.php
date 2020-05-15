<?php
namespace Cylancer\Loginviaemail\XClass;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

/**
 * Extension class for Front End User Authentication.
 *
 * This extension allows the login via e-mail or via user name.
 */
class CyFrontendUserAuthentication extends \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication
{

    protected $email_column = 'email';

    /**
     * Returns an info array with Login/Logout data submitted by a form or params
     *
     * @return array
     * @see FrontendUserAuthentication::getLoginFormData()
     */
    public function getLoginFormData()
    {
        $username = GeneralUtility::_POST($this->formfield_uname);
        if ($username != null) {
            $_POST[$this->formfield_uname] = $this->mapEMailToUsername($username);
        }
        $username = GeneralUtility::_GET($this->formfield_uname);
        if ($username != null) {
            $_GET[$this->formfield_uname] = $this->mapEMailToUsername($username);
        }
        return parent::getLoginFormData();
    }

    /**
     * If you can deduce exactly one user name from the given e-mail address,
     * the determined user name is returned.
     * In all other cases the given $email
     * will be returned unchanged.
     *
     * @param String $email
     *            is possibly an e-mail address.
     */
    private function mapEMailToUsername($_email)
    {

        // email is _email without whitespaces
        $email = trim($_email);

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $_email;
        }

        $qb = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)->getQueryBuilderForTable($this->user_table);
        $p_email = $qb->createNamedParameter($email);
        $rows = $qb->select($this->username_column, $this->email_column)
            ->from($this->user_table)
            ->where($qb->expr()
            ->eq($this->username_column, $p_email))
            ->orWhere($qb->expr()
            ->eq($this->email_column, $p_email))
            ->execute()
            ->fetchAll();

        if (count($rows) == 1) {
            return $rows[0][$this->username_column];
        } else {
            return $_email;
        }
    }
}
