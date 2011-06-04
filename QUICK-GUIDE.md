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
  public function indexAction($name)
  {
    return $this->render('IARISSTodoBundle:Todo:index.html.twig', array('name' => $name));

  }
}
```
 3. Le fichier pour router le Bundle

```yaml
# ./src/IARISS/TodoBundle/Resources/config/routing.yml

todo_list:
    pattern:  /todo/{name}
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

= La configuration de l'application pour intéreger le Bundle

 1. Enregistrer l'« entreprise ». Avoir un `./app/autoload.php` qui ressemble à 

```php
<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
// ...
    'IARISS'           => __DIR__.'/../src',
));
// ...
```

 2. Enregistrer le Bundle. Avoir un AppKernel.php qui ressemble à

```php
<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\ClassLoader\DebugUniversalClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
// ...
            new IARISS\TodoBundle\IARISSTodoBundle(),
        );
// ...
```

 3. Enregistrer le fichier de route. Ajouter à `./app/config/routing.yml` les lignes

```yaml
todo:
    resource: "@IARISSTodoBundle/Resources/config/routing.yml"
```

= Premiers tests
Si vous avez bien tout suivi, vous devez avoir une arborescence qui ressemble à :

```
src/
└── IARISS
    └── TodoBundle
        ├── Controller
        │   └── TodoController.php
        ├── Entity
        ├── IARISSTodoBundle.php
        ├── Repository
        └── Resources
            ├── config
            │   ├── doctrine
            │   └── routing.yml
            └── views
                └── Todo
                    └── index.html.twig

```

Si vous allez sur `http://strombi.localhost/app_dev.php/todo/MyNameIsToto`, vous devriez voir « Hello MyNameIsToto » s'afficher.

= Premier objet Doctrine
