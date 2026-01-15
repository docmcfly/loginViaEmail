# Login via email extension for TYPO3 CMS

EN:
With the "Frontend user login" extension in the core, you can only log in with the user name. The e-mail
address that the user has entered in the  personal data cannot be used.

This extension extends the authorization mechanism:

If an email address is entered as the username, the corresponding user is identified. Only if the user
name can be uniquely assigned to the e-mail address will the user name be passed to the authorization
mechanism and the login be carried out with it.

DE:
Mit der im Core befindlichen "Frontend user login"-Erweiterung kann man sich nur mit dem
Nutzernamen einloggen. Die E-Mail-Adresse, die der Nutzer in den persönlichen Daten hinterlegt hat,
kann man nicht verwenden.

Diese Erweiterung erweitert den Authorisationsmechanismus:

Wenn eine E-Mail-Adresse als Nutzername angeben wurde, wird der dazugehörige Nutzer identifiziert.
Nur wenn der Nutzername eindeutig zur E-Mail-Adresse zugeordnet werden kann, wird dem
Authorisationsmechanismus der Nutzername übergeben und mit diesem das Login durchgeführt.

## CHANGELOG

* 5.1.0 :: Change service API
* 5.0.2 :: Clean coding
* 5.0.1 :: Add a extension icon
* 5.0.0 :: TYPO3 13.4 compatibility
* 4.0.0 :: TYPO3 12.4 compatibility
* 3.0.2 :: Small optimation
* 3.0.1 :: Update the extension icon
* 3.0.0 :: Initial
