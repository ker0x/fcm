<?php
namespace ker0x\Fcm\Message;

interface BuilderInterface
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function build(): array;
}