<?php

namespace App\Controller;

use App\Dto\CombineDto;
use App\Dto\HashDto;
use App\Dto\ResultDto;
use App\Entity\Combo;
use App\Entity\Rune;
use App\Provider\DataTable\ComboTableProvider;
use App\Repository\ComboRepository;
use App\Repository\ElementRepository;
use App\Repository\RuneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Json;

class AppController extends AbstractController
{

    public function index(ElementRepository $elementRepository){
        $elements = $elementRepository->findBy(['isCapped' => 0]);
        return $this->render('combine.html.twig', [
            'elements' => $elements
        ]);
    }

    public function combine(
        CombineDto $combineDto,
        ComboRepository $comboRepository,
        RuneRepository $runeRepository,
        EntityManagerInterface $entityManager
    ){
        $rune = $runeRepository->findOneBy([
            'hash' => $combineDto->getHash(),
            'wasUsed' => 0
        ]);

        if($rune){
            $rune->setWasUsed(true);
            $entityManager->persist($rune);
            $entityManager->flush();

            $combo = $comboRepository->findOneByIngredients($combineDto->getFirstIngredient(),$combineDto->getSecondIngredient());
            $resultDto = new ResultDto($combo,$combineDto);
            return new JsonResponse([
                'data' => [
                    'name' => $resultDto->getName(),
                    'cooldown' => "(".$resultDto->getCooldown().")",
                    'effect' => $resultDto->getEffect(),
                    'errorMessage' => $resultDto->getErrorMessage(),
                    'isCapped' => $resultDto->getIsCapped(),
                    'requirments' => $resultDto->getRequirments()
                ]
            ]);
        }

        return new JsonResponse([
            'data' => [
                'name' => '',
                'cooldown' => '',
                'effect' => '',
                'errorMessage' => 'Wrong rune',
                'isCapped' => '',
                'requirments' => ''
            ]
        ]);
    }

    public function rune(){
        return $this->render('rune.html.twig');
    }

    public function runeSave(
        HashDto $hashDto,
        RuneRepository $runeRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse{

        $isAvailable = $runeRepository->findOneBy([
            'hash' => $hashDto->getHash(),
            'wasUsed' => 0
        ]);
        if($isAvailable){
            return new JsonResponse([
                'message' => 'Existing unused Hash'
            ]);
        }
        $rune = (new Rune())->setHash($hashDto->getHash())->setWasUsed(false);

        $entityManager->persist($rune);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'success'
        ]);
    }

    public function combo(
        Request $request,
        ComboTableProvider $comboTableProvider
    ): Response{
        $table = $comboTableProvider->getTable($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('combo.html.twig',[
            'table' => $table,
        ]);
    }

    public function comboSave(
        Request $request,
        ComboRepository $comboRepository,
        EntityManagerInterface $entityManager
    ): JsonResponse{
        $combo = $comboRepository->find($request->request->get('id'));
        if($combo){
            $combo->setEffect($request->request->get('effect'));
            $combo->setCooldown($request->request->get('cooldown'));
            $entityManager->persist($combo);
            $entityManager->flush();
        }
        return new JsonResponse(['message' => 'Data saved successfully']);
    }
}