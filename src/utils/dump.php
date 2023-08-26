<?php

declare(strict_types = 1);

function dump($object) {
   echo '<div style="
   border: 2px dashed black;
   padding: 20px;
   display: inline-block;">
   <pre>';
   
   var_dump($object);
   
   echo '</pre></div>';
}