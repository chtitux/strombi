QUICK GUIDE to symfony2

== Installation

 1. Télécharger Symfony Standard Edition avec Vendors
 2. Le décompresser 
 3. Placer le DocumentRoot sur `./web/`
 4. Apache doit avoir les droits d'écriture dans `./app/cache/`

== Premier Bundle

 1. Créer un dossier portant le nom de l'enteprise dans `./src/` (ex `IARISS/`)
 2. Créer un dossier portant le nom du Bundle dans ce dossier, et y créer 4 autres dossiers : `Controller, Entity, Repository` et `Resources` :

```
 mkdir Controller  Entity  Repository  Resources
 mkdir -p Resources/config/doctrine
 mkdir -p Resources views
```

== Code
 1. Bundle

```php
// Fichier ./src/IARISS/TodoBundle/IARISSTodoBundle.php
<?php

namespace IARISS\TodoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IARISSTodoBundle extends Bundle
{
}

```
 2. Controller d'exemple :

```php
<?php
// Fichier ./src/IARISS/TodoBundle/Controller/DefaultController.php
<?php

namespace IARISS\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
  public function indexAction($name)
  {
    return $this->render('IARISSTodoBundle:Default:index.html.twig');

  }
}
```
