<?php

namespace AppBundle\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class RecipePictureSeralizer implements EventSubscriberInterface {

    private $routePicturePathRecipe;

    public function __construct($routePicturePathRecipe) {
        $this->routePicturePathRecipe = $routePicturePathRecipe;
    }

    public static function getSubscribedEvents() {
        return array(
            array(
                'event' => 'serializer.post_serialize',
                'method' => 'onPostSerialize',
                'class' => 'AppBundle\Entity\Recipe',
                'format' => 'json',
                'priority' => 0, 
            ),
        );
    }

    public function onPostSerialize(ObjectEvent $event) {

        $path = $this->routePicturePathRecipe . $event->getObject()->getPicture();
        
        $file = fopen($path, "rb");
        $contents = fread($file, filesize($path));
        $encoded_image = base64_encode($contents);

        $event->getVisitor()->addData('picture_binaire', $encoded_image);
    }

}
