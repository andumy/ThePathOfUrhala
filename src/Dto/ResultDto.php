<?php

namespace App\Dto;

use App\Entity\Combo;

class ResultDto
{
    private string $name;
    private string $effect;
    private bool $isSuccess;
    private string $errorMessage;
    private bool $isCapped;

    public function __construct(?Combo $combo, CombineDto $combineDto){
        if($combo == null){
            $this->isSuccess = true;
            $this->errorMessage = 'The combination generated just some smoke and a fart smell';
            $this->isCapped = false;
            $this->name = '';
            $this->effect = '';
        }
        if($this->canMorph($combo,$combineDto)){
            $this->isSuccess = true;
            $this->errorMessage = '';
            $this->isCapped = $combo->getIsCapped();
            $this->name = $combo->getResult()->getName();
            $this->effect = $combo->getEffect();
        } else {
            $this->isSuccess = false;
            $this->errorMessage = $this->computeErrorMessage($combo,$combineDto);
            $this->isCapped = false;
            $this->name = '';
            $this->effect = '';
        }
    }

    private function canMorph(Combo $combo, CombineDto $combineDto): bool{
        return $combo->getCrylo() <= $combineDto->getCrylo() &&
            $combo->getDeto() <= $combineDto->getDeto() &&
            $combo->getMozo() <= $combineDto->getMozo() &&
            $combo->getRuto() <= $combineDto->getRuto();
    }

    private function computeErrorMessage(Combo $combo, CombineDto $combineDto): string{
        $message = '';

        if($combo->getCrylo() > $combineDto->getCrylo()){
            $message .= 'You do not have enough Crylo points to perform the morph.<br>';
        }
        if($combo->getDeto() > $combineDto->getDeto()){
            $message .= 'You do not have enough Deto points to perform the morph.<br>';
        }
        if($combo->getMozo() > $combineDto->getMozo()){
            $message .= 'You do not have enough Mozo points to perform the morph.<br>';
        }
        if($combo->getRuto() > $combineDto->getRuto()){
            $message .= 'You do not have enough Ruto points to perform the morph.<br>';
        }
        return $message;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEffect(): string
    {
        return $this->effect ?? '';
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @return string
     */
    public function getIsCapped(): string
    {
        return $this->isCapped ? '<i class="fas fa-ban h2"></i>' : '';
    }



}