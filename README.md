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
To run tests, run the following commands:
 $ cd my-workspace/encrypt-me/
 $ phpunit <test name> <test class>
 
 Example:
 $ cd /home/user/workspace/encrypt-me/
 $ phpunit BlockTranspositionTest tests/algorithms/BlockTranspositionTest.class.php
 