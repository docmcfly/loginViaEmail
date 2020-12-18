# loginViaEmail
Allows login via email in the content management system TYPO3


------------------------------------------------------------

Note: The extension loses beta status when it has been downloaded 100 times and all issues have been resolved. 

## Description 
### English
The "Frontend user login" extension in the core can only be logged in with the user name.  The e-mail address that the user has entered in the personal data cannot be used. 

This extension extends the authorization mechanism: 

If an e-mail address is specified as the user name, the associated user is identified. Only if the username can be uniquely assigned to the e-mail address, the authorization mechanism is executed with this username. 


### German :: Deutsch
Mit der im Core befindlichen "Frontend user login"-Erweiterung kann man sich nur mit dem Nutzernamen einloggen. Die E-Mail-Adresse, die der Nutzer in den persönlichen Daten hinterlegt hat, kann man nicht verwenden.

Diese Erweiterung erweitert den Authorisationsmechanismus: 

Wenn eine E-Mail-Adresse als Nutzername angeben wurde, wird der dazugehörige Nutzer identifiziert. Nur wenn der Nutzername eindeutig zur E-Mail-Adresse zugeordnet werden kann, wird der Authorisationsmechanismus mit diesem Nutzernamen durchgeführt. 


## Release notes

### 1.0 
The first version uses the xclass replacement mechanism. It works with Typo3 version 8.7 - 10.4, but the Typo3 reports contain warnings with a hint for the xclass replacement. 

### 2.0
The second version uses its own authentication service. Because the new service is derived from the Typo3-FrontendUser-Service, it offers everything of the normal Typo3-behavior and also the login via e-mail. 

I do not have an old typo3 lts version (8.7 or 9.5). This is the reason why I publish the extension only for typo3 10.4.x. 

Hint: To stay closer to the standard, login via URL is no longer allowed.  
