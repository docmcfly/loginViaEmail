<?php

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
        'className' => Cylancer\Loginviaemail\Services\EMailFrontendUserAuthenticationService::class
    ]);

