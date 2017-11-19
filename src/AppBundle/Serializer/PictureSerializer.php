<?php

namespace AppBundle\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class PictureSerializer implements EventSubscriberInterface {

    private $routePicturePath;

    public function __construct($routePicturePath) {
        $this->routePicturePath = $routePicturePath;
    }

    public static function getSubscribedEvents() {
        return array(
            array(
                'event' => 'serializer.post_serialize',
                'method' => 'onPostSerialize',
                'class' => 'AppBundle\Entity\Product',
                'format' => 'json',
                'priority' => 0, 
            ),
        );
    }

    public function onPostSerialize(ObjectEvent $event) {

        $path = $this->routePicturePath . $event->getObject()->getPicture();
        
        $file = fopen($path, "rb");
        $contents = fread($file, filesize($path));
        $encoded_image = base64_encode($contents);

        $event->getVisitor()->addData('picture_bin', $encoded_image);
    }

}
