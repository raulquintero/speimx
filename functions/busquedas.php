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
function searchCATEGORIA($id, $array) {
   foreach ($array as $key => $val) {
       if ($val['temporada_id'] === $id) {
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