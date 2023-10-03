<?php

/**
 * This file is part of the "login via email" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Clemens Gogolin <service@cylancer.net>
 * 
 */

$EM_CONF[$_EXTKEY] = array(
    'title' => 'LoginViaEMail',
    'description' => 'EN:
With the "Frontend user login" extension in the core, you can only log in with the user name. The e-mail address that the user has entered in the 
personal data cannot be used.
    
This extension extends the authorization mechanism:
    
If an email address is entered as the username, the corresponding user is identified. Only if the user name can be uniquely assigned to the e-mail 
address will the user name be passed to the authorization mechanism and the login be carried out with it.
    
DE:
Mit der im Core befindlichen "Frontend user login"-Erweiterung kann man sich nur mit dem Nutzernamen einloggen. 
Die E-Mail-Adresse, die der Nutzer in den persönlichen Daten hinterlegt hat, kann man nicht verwenden.
    
Diese Erweiterung erweitert den Authorisationsmechanismus:
    
Wenn eine E-Mail-Adresse als Nutzername angeben wurde, wird der dazugehörige Nutzer identifiziert. Nur wenn der Nutzername 
eindeutig zur E-Mail-Adresse zugeordnet werden kann, wird dem Authorisationsmechanismus der Nutzername übergeben und mit diesem das Login durchgeführt.',
    'category' => 'misc',
    'version' => '3.0.2',
    'state' => 'stable',
    'uploadfolder' => false,
    'clearcacheonload' => false,
    'author' => 'Clemens Gogolin',
    'author_email' => 'service@cylancer.net',
    'author_company' => NULL,
    'constraints' => array(
        'depends' => array(
            'typo3' => '11.5.0-11.5.99'
        ),
        'conflicts' => array(),
        'suggests' => array()
    )
);


/* ---- CHANGELOG ---------- 
 
 3.0.0 :: Initial
 3.0.1 :: Update the extension icon
 3.0.2 :: Small database query optimization
 
   ---- CHANGELOG ---------- */

