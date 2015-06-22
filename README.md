Symfony Test Task: User Widget
========================

This is the test symfony application.

Installation
--------------

    git clone git@github.com:frexin/Symfony-Test-App.git
    composer install
    php app/console doctrine:migrations:migrate

FakeData generator
--------------

This app using fixture generator library - [Alice](https://packagist.org/packages/nelmio/alice).
You can populate database with random records using next command:

    php app/console h4cc_alice_fixtures:load:sets -m default src/Frexin/UwidgetBundle/Fixtures/DefaultSet.php


Tests
-----

Application comes with unit and functional tests. PHPUnit is required.
Command for running test suites:

    phpunit -c app

Usage
-----

URI format for generating widget file:

    /user/{userhash}/width/{width}/height/{height}/bgcolor/{hexcolor}/textcolor/{hexcolor}

Example:

    /user/dj38dkf/width/100/height/100/bgcolor/C94C08/textcolor/E3CF3B