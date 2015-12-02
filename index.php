<?php 
 //   $startTime = microtime(true);  
    // Your content to test

function class_loader($class){
require('classes/' . $class . '.php');//---- might be a badly named model if gives error here   
}
spl_autoload_register('class_loader');

$rh = new requestHandler();

$rh->getContent();
echo$rh->output;


 //$endTime = microtime(true);  
 //   $elapsed = $endTime - $startTime;
 //   echo "Execution time : $elapsed seconds";
