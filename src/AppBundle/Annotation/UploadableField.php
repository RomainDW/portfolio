<?php

namespace AppBundle\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class UploadableField
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $path;

    public function __construct(array $options)
    {
        if (empty($options['filename'])){
            throw new \InvalidArgumentException("Erreur");
        }
        if (empty($options['path'])){
            throw new \InvalidArgumentException("Erreur");
        }
        $this->filename = $options['filename'];
        $this->path = $options['path'];
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function getPath()
    {
        return $this->path;
    }

}