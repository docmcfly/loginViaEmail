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

 use Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService;

defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addService(
    // Extension Key
    'cylancer',
    // Service type
    'auth',
    // Service key
    'Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService',
    [
        'title' => 'Login via email',
        'description' => 'Allows a login with the e-mail address as username',
        
        'subtype' => 'getUserFE,authUserFE',
        
        'available' => true,
        'priority' => 60,
        'quality' => 50,
        
        'os' => '',
        'exec' => '',
        'className' => EMailFrontendUserAuthenticationService::class
    ]);

