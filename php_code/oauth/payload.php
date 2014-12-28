<?php
print_r('recieved payload:<br>');
print_r(json_decode(file_get_contents("php://input"), true));
?>
