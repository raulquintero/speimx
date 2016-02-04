<?php
function searchSKU($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['sku'] === $id) {
           return true;
       }
   }
   return false;
}
function notsearchSKU($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['sku'] <> $id) {
           return true;
       }
   }
   return false;
}


function searchMultiarray($value,$key, $array) {
   foreach ($array as $key => $val) {
       if ($val[$key] === $value) {
           return $key;
       }
   }
   return null;
}




?>