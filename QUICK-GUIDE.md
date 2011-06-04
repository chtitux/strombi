QUICK GUIDE to symfony2

# Installation

 1. Télécharger Symfony Standard Edition avec Vendors
 2. Le décompresser 
 3. Placer le DocumentRoot sur `./web/`
 4. Apache doit avoir les droits d'écriture dans `./app/cache/`

# Premier Bundle

 1. Créer un dossier portant le nom de l'enteprise dans `./src/` (ex `IARISS/`)
 2. Créer un dossier portant le nom du Bundle dans ce dossier, et y créer 4 autres dossiers : `Controller, Entity, Repository` et `Resources` :

```
 mkdir Controller  Entity  Repository  Resources
 mkdir -p Resources/config/doctrine
 mkdir -p Resources/views/Todo
```

# Code

 1. Bundle

```php
<?php
// Fichier ./src/IARISS/TodoBundle/IARISSTodoBundle.php

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

namespace IARISS\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
  public function indexAction()
  {
    return $this->render('IARISSTodoBundle:Todo:index.html.twig', array('name' => "First task"));

  }
}
```
 3. Le fichier pour router le Bundle

```yaml
# ./src/IARISS/TodoBundle/Resources/config/routing.yml

todo_list:
    pattern:  /todo/
    defaults: { _controller: IARISSTodoBundle:Todo:index }
```

 4. La vue

```twig
 {# src/IARISS/TodoBundle/Resources/views/Todo/index.html.twig #}
 {% extends '::layout.html.twig' %}

 {% block body %}
     Hello {{ name }}!
 {% endblock %} 

```