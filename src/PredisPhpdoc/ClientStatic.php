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
class ClientStatic extends PredisClient
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

    /**
     * This command is used in order to read and reset the Redis slow queries log.
     *
     * @param string $subcommand "get"|"reset"|"len"
     * @param string $argument
     * @return array|null
     * @link http://redis.io/commands/slowlog
     */
    public function slowlog($subcommand, $argument = null)
    {
    }

    /**
     * The command behavior is the following:
     *  - Stop all the clients.
     *  - Perform a blocking SAVE if at least one save point is configured.
     *  - Flush the Append Only File if AOF is enabled.
     *  - Quit the server.
     * If persistence is enabled this commands makes sure that Redis is switched off without the lost of any data.
     * This is not guaranteed if the client uses simply SAVE and then QUIT because other clients may alter the DB data
     * between the two commands.
     *
     * @param string $save "SAVE"|"NOSAVE" [optional]
     * @return null
     * @link http://redis.io/commands/shutdown
     */
    public function shutdown($save = null)
    {
    }

    /**
     * Unsubscribes the client from the given channels, or from all of them if none is given.
     * When no channels are specified, the client is unsubscribed from all the previously subscribed channels.
     * In this case, a message for every unsubscribed channel will be sent to the client.
     *
     * @param string $channel,... [optional]
     * @return null
     * @link http://redis.io/commands/unsubscribe
     */
    public function unsubscribe($channel = null)
    {
    }

    /**
     * Unsubscribes the client from the given patterns, or from all of them if none is given.
     * When no patters are specified, the client is unsubscribed from all the previously subscribed patterns.
     * In this case, a message for every unsubscribed pattern will be sent to the client.
     *
     * @param string $pattern,... [optional]
     * @return null
     * @link http://redis.io/commands/punsubscribe
     */
    public function punsubscribe($pattern = null)
    {
    }

    /**
     * Client command with a few subcommands.
     *
     * @param string $subcommand
     * @param string $arg [optional]
     * @link http://redis.io/commands/client-kill
     * @link http://redis.io/commands/client-list
     * @link http://redis.io/commands/client-getname
     * @link http://redis.io/commands/client-setname
     */
    public function client($subcommand, $arg = null)
    {
    }
}
