Encrypt-me
==========
Encrypt-me is a set of historical cryptographic alogrithms.
It is provided for education purpose: you can verify your results or generate exercices if you are studying these algorithms.

Requirements
------------
The minimal requirements are:
 - Php 5.3 or higher

If you wan to run unit tests, you needs:
 - Pear
 - PHPUnit with its dependencies

Usage:
------
For now, only unit test are available.
To run a test, call phpunit with the test name and the class name:
 $ cd my-workspace/encrypt-me/
 $ phpunit <test name> <test class>

To run all tests, a phpunit configuration file is available:
 $ cd my-workspace/encrypt-me/
 $ phpunit --configuration phpunit-config.xml
 
