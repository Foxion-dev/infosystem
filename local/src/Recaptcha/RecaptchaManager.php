<?php
namespace Infosystems\Recaptcha;

use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\CurlPost;

class RecaptchaManager
{
    const SECRET_KEY = '';
    const SITE_KEY = '';

    /**
     * @var ReCaptcha
     */
    private $recaptcha;

    /**
     * @var string
     */
    private $hostName;

    /**
     * @var string
     */
    private $action = 'homepage';

    /**
     * @var float
     */
    private $score = 0.5;

    /**
     * @var string
     */
    private $remoteIp;

    /**
     * RecaptchaManager constructor.
     */
    public function __construct()
    {
        $this->recaptcha = new ReCaptcha(self::getSecretKey(), new CurlPost());

        $this->hostName = $_SERVER['SERVER_NAME'];
        $this->remoteIp = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param $token
     * @return \ReCaptcha\Response
     */
    public function verify($token)
    {
        return $this->recaptcha
            ->setExpectedHostname($this->hostName)
            ->setExpectedAction($this->action)
            ->setScoreThreshold($this->score)
            ->verify($token, $this->remoteIp);
    }

    /**
     * @param string $token
     * @return bool
     */
    public function isValid(string $token)
    {
        $result = $this->verify($token);

        if (!$result->isSuccess() || $result->getScore() < $this->getScore()) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public static function getSiteKey(): string
    {
        return self::SITE_KEY;
    }

    /**
     * @return string
     */
    private static function getSecretKey(): string
    {
        return self::SECRET_KEY;
    }

    /**
     * @param string $hostName
     */
    public function setHostName(string $hostName): void
    {
        $this->hostName = $hostName;
    }

    /**
     * @return string
     */
    public function getHostName(): string
    {
        return $this->hostName;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
    }

    /**
     * @return float
     */
    public function getScore(): float
    {
        return $this->score;
    }

    /**
     * @param string $remoteIp
     */
    public function setRemoteIp(string $remoteIp): void
    {
        $this->remoteIp = $remoteIp;
    }

    /**
     * @return string
     */
    public function getRemoteIp(): string
    {
        return $this->remoteIp;
    }
}

