<?php

function returnRandomString() {
    $animals = array('rabbits', 'cats', 'puppies', 'chinchillas');
    $count = rand(100, 100000);
    return 'I have ' . $count . ' ' . $animals[array_rand($animals)] . '!';
};
