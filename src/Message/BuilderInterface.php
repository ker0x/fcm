<?php
namespace Kerox\Fcm\Message;

interface BuilderInterface
{
    /**
     * Build the instance.
     *
     * @return object
     */
    public function build();
}
