<style type="text/css">
/* ============================================================
  COMMON
============================================================ */
#wrapper {
  min-width: 600px;
}

.settings {
  display: table;
  /*background-color: gray;*/

  width: 100%;
}
/*.settings*/
 .row {
  /*display: table-row;*/
  background-color: white;
  border: 1px solid #cccccc;
  -webkit-border-radius: 20px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
}
.settings .question,
.settings .switch {
  display: table-cell;
  vertical-align: middle;
  padding: 10px;
}
.settings .question {
  width: 690px;
  font-family: "Roboto Slab", serif;
  font-size: 20px;
}

/* ============================================================
  COMMON
============================================================ */
.cmn-toggle {
  position: absolute;
  margin-left: -9999px;
  visibility: hidden;
}
.cmn-toggle + label {
  display: block;
  position: relative;
  cursor: pointer;
  outline: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* ============================================================
  SWITCH 1 - ROUND
============================================================ */
input.cmn-toggle-round + label {
  padding: 2px;
  width: 60px;
  height: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 20px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
}
input.cmn-toggle-round + label:before, input.cmn-toggle-round + label:after {
  display: block;
  position: absolute;
  top: 1px;
  left: 1px;
  bottom: 1px;
  content: "";
}
input.cmn-toggle-round + label:before {
  right: 1px;
  background-color: #f1f1f1;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.4s;
  -moz-transition: background 0.4s;
  -o-transition: background 0.4s;
  transition: background 0.4s;
}
input.cmn-toggle-round + label:after {
  width: 30px;
  background-color: #fff;
  -webkit-border-radius: 100%;
  -moz-border-radius: 100%;
  -ms-border-radius: 100%;
  -o-border-radius: 100%;
  border-radius: 100%;
  -webkit-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -moz-box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  -webkit-transition: margin 0.4s;
  -moz-transition: margin 0.4s;
  -o-transition: margin 0.4s;
  transition: margin 0.4s;
}
input.cmn-toggle-round:checked + label:before {
  background-color: #8ce196;
}
input.cmn-toggle-round:checked + label:after {
  margin-left: 32px;
}

/* ============================================================
  SWITCH 2 - ROUND FLAT
============================================================ */
input.cmn-toggle-round-flat + label {
  padding: 2px;
  width: 60px;
  height: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.4s;
  -moz-transition: background 0.4s;
  -o-transition: background 0.4s;
  transition: background 0.4s;
}
input.cmn-toggle-round-flat + label:before, input.cmn-toggle-round-flat + label:after {
  display: block;
  position: absolute;
  content: "";
}
input.cmn-toggle-round-flat + label:before {
  top: 2px;
  left: 2px;
  bottom: 2px;
  right: 2px;
  background-color: #fff;
  -webkit-border-radius: 60px;
  -moz-border-radius: 60px;
  -ms-border-radius: 60px;
  -o-border-radius: 60px;
  border-radius: 60px;
  -webkit-transition: background 0.4s;
  -moz-transition: background 0.4s;
  -o-transition: background 0.4s;
  transition: background 0.4s;
}
input.cmn-toggle-round-flat + label:after {
  top: 4px;
  left: 4px;
  bottom: 4px;
  width: 30px;
  background-color: #dddddd;
  -webkit-border-radius: 52px;
  -moz-border-radius: 52px;
  -ms-border-radius: 52px;
  -o-border-radius: 52px;
  border-radius: 52px;
  -webkit-transition: margin 0.4s, background 0.4s;
  -moz-transition: margin 0.4s, background 0.4s;
  -o-transition: margin 0.4s, background 0.4s;
  transition: margin 0.4s, background 0.4s;
}
input.cmn-toggle-round-flat:checked + label {
  background-color: #8ce196;
}
input.cmn-toggle-round-flat:checked + label:after {
  margin-left: 60px;
  background-color: #8ce196;
}

/* ============================================================
  SWITCH 3 - YES NO
============================================================ */
input.cmn-toggle-yes-no + label {
  padding: 2px;
  width: 60px;
  height: 30px;
}
input.cmn-toggle-yes-no + label:before, input.cmn-toggle-yes-no + label:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  color: #fff;
  font-family: "Roboto Slab", serif;
  font-size: 20px;
  text-align: center;
  line-height: 60px;
}
input.cmn-toggle-yes-no + label:before {
  background-color: #dddddd;
  content: attr(data-off);
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  -o-transition: -o-transform 0.5s;
  transition: transform 0.5s;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
}
input.cmn-toggle-yes-no + label:after {
  background-color: #8ce196;
  content: attr(data-on);
  -webkit-transition: -webkit-transform 0.5s;
  -moz-transition: -moz-transform 0.5s;
  -o-transition: -o-transform 0.5s;
  transition: transform 0.5s;
  -webkit-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
  transform: rotateY(180deg);
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  -o-backface-visibility: hidden;
  backface-visibility: hidden;
}
input.cmn-toggle-yes-no:checked + label:before {
  -webkit-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -o-transform: rotateY(180deg);
  transform: rotateY(180deg);
}
input.cmn-toggle-yes-no:checked + label:after {
  -webkit-transform: rotateY(0);
  -moz-transform: rotateY(0);
  -ms-transform: rotateY(0);
  -o-transform: rotateY(0);
  transform: rotateY(0);
}

</style>


<?php

$q=isset($_GET['q']) ? $_GET['q'] : "";

switch($q){
  case "off": $salida = shell_exec('./wemo 192.168.1.4 OFF'); break;
  case "on": $salida = shell_exec('./wemo 192.168.1.4 ON'); break;
  case "status": $salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); break;
}

//if (!$q) header("Location: /index.php?data=appliances");

$salida="ON";
//$salida = shell_exec('./wemo 192.168.1.4 GETSTATE'); 
$salida= str_replace("\n", "", $salida);

if ($salida=="OFF"){
    $status=" ";
    //echo "SWITCH 1 <a href='/index.php?data=appliances&q=on' onclick='' class=\"btn btn-success\">ON ($salida)</a>";
  }
if ($salida=="ON" || $salida==1){
    $status=" checked ";
      //echo "SWITCH 1 <a href='/index.php?data=appliances&q=off' onclick='' class=\"btn btn-warning\">OFF ($salida)</a>";
}



//echo "$salida -- $status -- $cuantos";


?>



  <div id="main">
    <div class="container">

      <div class="settings">

        <div class="row">
          <div class="question">
            Switch 1
          </div>
          <div class="switch">
            <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox" <?php echo $status; ?> >
            <label for="cmn-toggle-1"></label>
          </div>
        </div><!-- /row -->
<br>
        <div class="row">
          <div class="question">
            Switch 2
          </div>
          <div class="switch">
            <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" type="checkbox" <?php echo $status; ?> >
            <label for="cmn-toggle-2"></label>
          </div>
        </div><!-- /row -->
       

       <!--  <div class="row">
          <div class="question">
            What about HTML9?
          </div>
          <div class="switch">
            <input id="cmn-toggle-9" class="cmn-toggle cmn-toggle-yes-no" type="checkbox">
            <label for="cmn-toggle-9" data-on="Zing!" data-off="Brr?"></label>
          </div>
        </div><!-- /row ->
 -->
      </div>

    </div>
  </div><!-- #main -->

