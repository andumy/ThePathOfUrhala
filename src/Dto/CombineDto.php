<?php

namespace App\Dto;


use Symfony\Component\HttpFoundation\RequestStack;

class CombineDto
{
    private string $firstIngredient;
    private string $secondIngredient;
    private int $deto;
    private int $mozo;
    private int $ruto;
    private int $crylo;
    private string $hash;

    public function __construct(RequestStack $request)
    {
        $this->firstIngredient = (string) $request->getCurrentRequest()->request->get('firstIngredient');
        $this->secondIngredient = (string) $request->getCurrentRequest()->request->get('secondIngredient');
        $this->deto = (int) $request->getCurrentRequest()->request->get('deto');
        $this->mozo = (int) $request->getCurrentRequest()->request->get('mozo');
        $this->ruto = (int) $request->getCurrentRequest()->request->get('ruto');
        $this->crylo = (int) $request->getCurrentRequest()->request->get('crylo');
        $this->hash = (string) $request->getCurrentRequest()->request->get('hash');
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string
     */
    public function getFirstIngredient(): string
    {
        return $this->firstIngredient;
    }

    /**
     * @return string
     */
    public function getSecondIngredient(): string
    {
        return $this->secondIngredient;
    }

    /**
     * @return int
     */
    public function getDeto(): int
    {
        return $this->deto;
    }

    /**
     * @return int
     */
    public function getMozo(): int
    {
        return $this->mozo;
    }

    /**
     * @return int
     */
    public function getRuto(): int
    {
        return $this->ruto;
    }

    /**
     * @return int
     */
    public function getCrylo(): int
    {
        return $this->crylo;
    }

}