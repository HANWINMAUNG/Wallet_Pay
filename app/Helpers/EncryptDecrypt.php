<?php

use Hashids\Hashids;

 function idToHash($id){
    $sqids = new Hashids('wallet@han', 10);
    return $sqids->encode($id); // "86Rf07xd4z"
};
 function hashToId($hash){
    $sqids = new Hashids('wallet@han', 10);
    return $sqids->decode($hash)[0]; // [1, 2, 3]
};