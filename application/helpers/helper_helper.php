<?php 

    function make_GUID(){
            $node=openssl_random_pseudo_bytes(16);
            assert(strlen($node) == 16);
            $node[6] = chr(ord($node[6]) & 0x0f | 0x40); // set version to 0100
            $node[8] = chr(ord($node[8]) & 0x3f | 0x80); // set bits 6-7 to 10
            return strtoupper(vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($node), 4)));
    }
 ?>