QUICK GUIDE to symfony2

# Installation

 1. Télécharger Symfony Standard Edition avec Vendors
 2. Le décompresser 
 3. Placer le DocumentRoot sur `./web/`
 4. Apache doit avoir les droits d'écriture dans `./app/cache/`
 5. Mettre les bonnes valeurs dans `./app/parameters.ini` pour la base de données :

```
[parameters]
    database_driver="pdo_mysql"
    database_host="localhost"
    database_name="strombi"
    database_user="strombi"
    database_password="ZisIs4Passwordz"
    mailer_transport="smtp"
    mailer_host="localhost"
    mailer_user=""
    mailer_password=""
    locale="en"
    secret="191219898c58834e9ad0410712345f764"

```
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

Les objets Doctrine sont décrits par 2 fichiers : le premier dans `Entity/`, et qui sera l'objet que stockera PHP, et le second dans `Resources/config/doctrine/Monobjet.orm.yml` , qui fera le lien avec la base (MySQL ici)
Le premier fichier pourra être généré à partir du second.

 1. Le fichier Doctrine :

```yaml
IARISS\TodoBundle\Entity\Task:
  type: entity
  table: task
  repositoryClass: IARISS\TodoBundle\Repository\TaskRepository
  id:
    id:
      type: integer
      generator:
        strategy: AUTO
  fields:
      name: { type: string, length: 255 }
      description: { type: string, length: 4000 }
```

 2. Pour générer le fichier de la classe, il suffit de faire depuis la racine du projet :

```
  ./app/console doctrine:generate:entities IARISSTodoBundle
  Generating entities for bundle "IARISSTodoBundle"
  > generating IARISS\TodoBundle\Entity\Task

```
On se retrouve avec un fichier avec des variables privées, des _getters_ et des _setters_.

 3. Toutes les requêtes à la base de données devraient être codées dans un _Repository_ comme ça :

```php
<?php
// Fichier ./src/IARISS/TodoBundle/Repository/TaskRepository.php

namespace IARISS\TodoBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT t FROM IARISS\TodoBundle\Entity\Task t
                                    ORDER BY t.name ASC')
                    ->getResult();
    }
}
```

 4. Créez la base correspondante, puis la table si ce n'est pas déjà fait :
```
 ./app/console  doctrine:database:create 
 ./app/console  doctrine:schema:create
```
Si la table existe déjà, regardez ce que Symfony compte faire et exécutez l'update:

```
 ./app/console  doctrine:schema:update --dump-sql
 ./app/console  doctrine:schema:update --force
```