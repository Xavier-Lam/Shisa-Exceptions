<?php

namespace Shisa\Exceptions;


/**
 * Exception thrown when the requested resource is unauthorized.
 */
class Unauthorized extends ClientError
{
    public static $defaultStatusCode = 401;

    private $challenges = [];

    /**
     * Add a new challenge to the list.
     *
     * @param string $scheme Authentication scheme name.
     * @param array $params Additional parameters for the challenge.
     * @return static
     */
    public function addChallenge(string $scheme, array $params = [])
    {
        $this->challenges[] = [
            'scheme' => $scheme,
            'params' => $params
        ];
        return $this;
    }

    /**
     * Clear all challenges from the list.
     * 
     * @return static
     */
    public function clearChallenges()
    {
        $this->challenges = [];
        return $this;
    }

    /**
     * Get the list of challenges for this exception.
     *
     * @return array<array{scheme:string, params:array}>
     *         An array of challenges, each containing a "scheme" string and a "params"
     *         array.
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext(
            $context,
            'challenges',
            $this->getChallenges()
        );
        return $context;
    }
}
