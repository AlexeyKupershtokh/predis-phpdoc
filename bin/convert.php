<?php

require(__DIR__ . '/../vendor/autoload.php');

$profile = new Predis\Profile\ServerVersionNext;

// copy class by another name from ukko
$file = file_get_contents(__DIR__ . '/../vendor/ukko/phpredis-phpdoc/src/Redis.php');
$file = str_replace('<?php', '<?php' . PHP_EOL . 'namespace PredisPhpdoc;' . PHP_EOL, $file);
$file = str_replace('class RedisException extends Exception {}', '', $file);
file_put_contents(__DIR__ . '/../src/PredisPhpdoc/Redis.php', $file);

// lowercase all commands
$class = new ReflectionClass('\PredisPhpdoc\Redis');
$methods = $class->getMethods();
$file = file_get_contents($class->getFileName());
usort(
    $methods,
    function ($a, $b) {
        return $a < $b;
    }
);
foreach ($methods as $method) {
    $name = $method->getName();
    $lc = strtolower($name);
    if ($lc == 'zunion' || $lc == 'zinter') {
        $lc .= 'store';
    }
    $file = str_replace($name, $lc, $file);
}
$file = str_replace("class Redis", "class RedisLC", $file);
//$file = str_replace("class RedisLC\n", "class RedisLC extends ClientStatic\n", $file);
file_put_contents(__DIR__ . '/../src/PredisPhpdoc/RedisLC.php', $file);

// load RedisLC and copy compatible commands to ClientDynamic class
$class = new ReflectionClass('\PredisPhpdoc\RedisLC');
$lines = file($class->getFileName());
$file = <<<F
<?php

namespace PredisPhpdoc;

use Predis\Client as PredisClient;

class ClientDynamic extends PredisClient
{

F;
foreach ($class->getMethods() as $method) {
    if ($profile->supportsCommand($method->getName())) {
        $file .= "    " . $method->getDocComment() . PHP_EOL;
        $code = join(
            PHP_EOL,
            array_slice($lines, $method->getStartLine() - 1, $method->getEndLine() - $method->getStartLine() + 1)
        );
        $code = str_replace(' {}', PHP_EOL . '    {' . PHP_EOL . '    }', $code);
        $code = str_replace('( ', '(', $code);
        $code = str_replace(' )', ')', $code);
        $file .= $code . PHP_EOL;
    }
}
$file .= <<<F
}

F;
file_put_contents(__DIR__ . '/../src/PredisPhpdoc/ClientDynamic.php', $file);

// load Client class in order to check for missing commands
$class = new ReflectionClass('\PredisPhpdoc\Client');
$methods = $class->getMethods();
$unusedCommands = array_diff_key(
    $profile->getSupportedCommands(),
    array_flip(array_map(function ($m) { return $m->getName();}, $methods)),
    array('echo' => 1, 'eval' => 1)
);
unset($unusedCommands['echo'], $unusedCommands['eval']);

print 'Missing commands in ukko/phpredis-phpdoc:' . PHP_EOL;
var_export($unusedCommands);
print PHP_EOL;
