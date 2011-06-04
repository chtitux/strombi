QUICK GUIDE to symfony2

== Installation

 1. Télécharger Symfony Standard Edition avec Vendors
 2. Le décompresser 
 3. Placer le DocumentRoot sur `./web/`
 4. Apache doit avoir les droits d'écriture dans `./app/cache/`

== Premier Bundle

 1. Créer un dossier portant le nom de l'enteprise dans `./src/` (ex `IARISS/`)
 2. Créer un dossier portant le nom du Bundle dans ce dossier, et y créer 3 autres dossiers : `Controller, Entity, Repository` et `Resources` :

```
 mkdir Controller  Entity  Repository  Resources
```
 3.