<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "loginviaemail"
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'LoginViaEMail',
    'description' => 'EN:
With the "Frontend user login" extension in the core, you can only log in with the user name. The e-mail address that the user has entered in the personal data cannot be used.
    
This extension extends the authorization mechanism:
    
If an email address is entered as the username, the corresponding user is identified. Only if the user name can be uniquely assigned to the e-mail address will the user name be passed to the authorization mechanism and the login be carried out with it.
    
Note: This extension also affects the login via URL. In other words, you can also use an e-mail address for login in the URL.
    
DE:
Mit der im Core befindlichen "Frontend user login"-Erweiterung kann man sich nur mit dem Nutzernamen einloggen. Die E-Mail-Adresse, die der Nutzer in den persönlichen Daten hinterlegt hat, kann man nicht verwenden.
    
Diese Erweiterung erweitert den Authorisationsmechanismus:
    
Wenn eine E-Mail-Adresse als Nutzername angeben wurde, wird der dazugehörige Nutzer identifiziert. Nur wenn der Nutzername eindeutig zur E-Mail-Adresse zugeordnet werden kann, wird dem Authorisationsmechanismus der Nutzername übergeben und mit diesem das Login durchgeführt.
    
Hinweis: Diese Erweiterung wirkt sich auch auf den Login via URL aus. Sprich: man kann dann auch eine E-Mail-Adresse fürs Login in der URL verwenden.
',
    'category' => 'misc',
    'author' => 'Clemens Gogolin',
    'author_email' => 'service@cylancer.net',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.9.13',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.32-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
