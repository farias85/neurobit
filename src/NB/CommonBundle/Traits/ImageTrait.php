<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:36
 */

namespace NB\CommonBundle\Traits;


trait ImageTrait {

    /**
     * @var \NB\MediaBundle\Entity\Media
     */
    private $image;

    /**
     * @return \NB\MediaBundle\Entity\Media
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \NB\MediaBundle\Entity\Media $image
     */
    public function setImage(\NB\MediaBundle\Entity\Media $image) {
        $this->image = $image;
    }
}