<?php
namespace Kerox\Fcm\Message;

interface BuilderInterface
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function build(): array;
}