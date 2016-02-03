<?php

function alert_hecho($title,$msg){


    echo "<div class=\"alert alert-success\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		<strong>$title</strong> $msg.
    </div>";
}
function alert_error($title,$msg){


    echo "<div class=\"alert alert-error\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		<strong>$title</strong> $msg.
    </div>";
}

function alert_block($title,$msg){


    echo "<div class=\"alert alert-block\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		<strong>$title</strong> $msg.
    </div>";
}

function alert_info($title,$msg){


    echo "<div class=\"alert alert-error\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">x</button>
		<strong>$title</strong> $msg.
    </div>";
}

?>


