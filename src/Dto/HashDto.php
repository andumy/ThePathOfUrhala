<?php

namespace App\Dto;

use Symfony\Component\HttpFoundation\RequestStack;

class HashDto
{
    private string $hash;
    public function __construct(RequestStack $request)
    {
        $this->hash = (string) $request->getCurrentRequest()->request->get('hash');
    }
    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }



}