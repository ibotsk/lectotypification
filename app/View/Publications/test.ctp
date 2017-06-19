<?php


new dBug($local);

new dBug(Hash::extract($local, '{n}.Publication'));
new dBug(Hash::insert(Hash::extract($local, '{n}.Publication'), '{n}.ipni', 0));
