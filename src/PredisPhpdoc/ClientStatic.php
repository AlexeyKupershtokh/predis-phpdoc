<?php

namespace PredisPhpdoc;

use Predis\Client as PredisClient;

/**
 * Helper autocomplete for php redis extension
 * @author Max Kamashev <max.kamashev@gmail.com>
 * @link https://github.com/ukko/phpredis-phpdoc
 *
 * @method echo string $string Sends a string to Redis, which replies with the same string
 *
 * @method  eval($script, $args = array(), $numKeys = 0)
 *  Evaluate a LUA script serverside
 * @param  string $script
 * @param  array $args
 * @param  int $numKeys
 * @return Mixed.  What is returned depends on what the LUA script itself returns, which could be a scalar value
 *  (int/string), or an array. Arrays that are returned can also contain other arrays, if that's how it was set up in
 *  your LUA script.  If there is an error executing the LUA script, the getLastError() function can tell you the
 *  message that came back from Redis (e.g. compile error).
 * @link   http://redis.io/commands/eval
 * @example
 *  <pre>
 *  $redis->eval("return 1"); // Returns an integer: 1
 *  $redis->eval("return {1,2,3}"); // Returns Array(1,2,3)
 *  $redis->del('mylist');
 *  $redis->rpush('mylist','a');
 *  $redis->rpush('mylist','b');
 *  $redis->rpush('mylist','c');
 *  // Nested response:  Array(1,2,3,Array('a','b','c'));
 *  $redis->eval("return {1,2,3,redis.call('lrange','mylist',0,-1)}}");
 * </pre>
 *
 */
class ClientStatic
{
    /**
     * Set the string value in argument as value of the key, with a time to live.
     * Psetx works exactly like setex with the sole difference that the expire time is specified in milliseconds instead
     * of seconds.
     *
     * @param   string $key
     * @param   int $ttl
     * @param   string $value
     * @return  bool:   TRUE if the command is successful.
     * @link    http://redis.io/commands/psetex
     * @example $redis->psetex('key', 3600000, 'value'); // sets key → value, with 1h TTL.
     */
    public function psetex($key, $ttl, $value)
    {
    }

    public function quit()
    {
    }

    public function slowlog()
    {
    }

    public function shutdown()
    {
    }

    public function monitor()
    {
    }

    public function unsubscribe()
    {
    }

    public function punsubscribe()
    {
    }

    public function client()
    {
    }
}
