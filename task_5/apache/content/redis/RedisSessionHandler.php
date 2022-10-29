<?php
class RedisSessionHandler implements \SessionHandlerInterface
{
    protected $redis;

    protected $ttl;

    protected $prefix;

    protected $locked;

    private $lockKey;

    private $token;

    private $spinLockWait;

    private $lockMaxWait;

    public function __construct(\Redis $redis, $prefix = 'PHPREDIS_SESSION:', $spinLockWait = 200000)
    {
        $this->redis = $redis;
        $this->ttl = ini_get('gc_maxlifetime');
        $iniMaxExecutionTime = ini_get('max_execution_time');
        $this->lockMaxWait = $iniMaxExecutionTime ? $iniMaxExecutionTime * 0.7 : 20;
        $this->prefix = $prefix;
        $this->locked = false;
        $this->lockKey = null;
        $this->spinLockWait = $spinLockWait;
    }

    public function open($savePath, $sessionName)
    {
        return true;
    }

    protected function lockSession($sessionId)
    {
        $attempts = (1000000 * $this->lockMaxWait) / $this->spinLockWait;
        $this->token = uniqid();
        $this->lockKey = $sessionId . '.lock';
        for ($i = 0; $i < $attempts; ++$i) {
            $success = $this->redis->set(
                $this->getRedisKey($this->lockKey),
                $this->token,
                [
                    'NX',
                ]
            );
            if ($success) {
                $this->locked = true;
                return true;
            }
            usleep($this->spinLockWait);
        }
        return false;
    }

    private function unlockSession()
    {
        $script = <<<LUA
if redis.call("GET", KEYS[1]) == ARGV[1] then
    return redis.call("DEL", KEYS[1])
else
    return 0
end
LUA;
        $this->redis->eval($script, array($this->getRedisKey($this->lockKey), $this->token), 1);
        $this->locked = false;
        $this->token = null;
    }

    public function close()
    {
        if ($this->locked) {
            $this->unlockSession();
        }
        return true;
    }

    public function read($sessionId)
    {
        if (!$this->locked) {
            if (!$this->lockSession($sessionId)) {
                return false;
            }
        }
        return $this->redis->get($this->getRedisKey($sessionId)) ?: '';
    }

    public function write($sessionId, $data)
    {
        if ($this->ttl > 0) {
            $this->redis->setex($this->getRedisKey($sessionId), $this->ttl, $data);
        } else {
            $this->redis->set($this->getRedisKey($sessionId), $data);
        }
        return true;
    }

    public function destroy($sessionId)
    {
        $this->redis->del($this->getRedisKey($sessionId));
        $this->close();
        return true;
    }

    public function gc($lifetime)
    {
        return true;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    public function getLockMaxWait()
    {
        return $this->lockMaxWait;
    }

    public function setLockMaxWait($lockMaxWait)
    {
        $this->lockMaxWait = $lockMaxWait;
    }

    protected function getRedisKey($key)
    {
        if (empty($this->prefix)) {
            return $key;
        }
        return $this->prefix . $key;
    }

    public function __destruct()
    {
        $this->close();
    }
}