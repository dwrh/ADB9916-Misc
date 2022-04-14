<?php

//chdir('c:\inetpub\vhosts\bearllc.net\cgi-bin\GAMS');
echo getcwd();	
//$cmd = 'echo "Hello Worlds!" > TSW.txt';
//$cmd = 'TSW.txt';

exec('TSW.txt 2>&1', $output, $result_status);
print_r($output);
echo $result_status;

?>
