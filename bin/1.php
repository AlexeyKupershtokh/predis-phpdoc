<?php

require(__DIR__ . '/../vendor/autoload.php');

$profile = new Predis\Profile\ServerVersionNext;

// copy class by another name from ukko
$file = file_get_contents(__DIR__ . '/../vendor/ukko/phpredis-phpdoc/src/Redis.php');
$file = str_replace('<?php', '<?php' . PHP_EOL . 'namespace PredisPhpdoc;' . PHP_EOL, $file);
file_put_contents(__DIR__ . '/../src/PredisPhpdoc/Redis.php', $file);

new \PredisPhpdoc\Redis();

$class = new ReflectionClass('\PredisPhpdoc\Redis');
$methods = $class->getMethods();
var_dump($methods);
var_dump($class->getFileName());
$file = file_get_contents($class->getFileName());
usort($methods, function ($a, $b) {
    return $a < $b;
});
foreach ($methods as $method) {
    var_dump($method->getDocComment());
    $name = $method->getName();
    $file = str_replace($name, strtolower($name), $file);
}
file_put_contents(__DIR__ . '/../src/PredisPhpdoc/ClientLC.php', $file);
