<?php
/**
 * Created by PhpStorm.
 * User: Frexin
 * Date: 22.06.15
 * Time: 3:43
 */

$set = new h4cc\AliceFixturesBundle\Fixtures\FixtureSet(array(
    'locale' => 'en_US',
    'seed' => 42,
    'do_drop' => true,
    'do_persist' => true,
));
$set->addFile(__DIR__.'/users.yml', 'yaml');
return $set;