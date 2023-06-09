<?php

namespace Shisa\Exceptions;


/**
 * Requested resource not found
 */
class NotFound extends ClientError
{
    public static $defaultStatusCode = 404;

    protected $queryConditions = null;

    protected $resourceType = null;

    /**
     * Get the failed query conditions that caused the exception.
     *
     * @return array|null
     */
    public function getQueryConditions()
    {
        return $this->queryConditions;
    }

    /**
     * Set the failed query conditions that caused the exception.
     * 
     * @return static
     */
    public function setQueryConditions(array $conditions)
    {
        $this->queryConditions = $conditions;
        return $this;
    }

    /**
     * Get the type of resource that was being looked for.
     *
     * @return string
     */
    public function getResourceType()
    {
        return $this->resourceType;
    }

    /**
     * Set the type of resource that was being looked for.
     * 
     * @return static
     */
    public function setResourceType(string $type)
    {
        $this->resourceType = $type;
        return $this;
    }

    public function getContext()
    {
        $context = parent::getContext();
        Helper::assignContext(
            $context,
            'query_conditions',
            $this->getQueryConditions()
        );
        Helper::assignContext(
            $context,
            'resource_type',
            $this->getResourceType()
        );
        return $context;
    }
}
