<?php
defined('TYPO3_MODE') || die('Access denied.');


$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::class] = [
   'className' =>  Cylancer\Loginviaemail\XClass\CyFrontendUserAuthentication::class
];



