<?php

namespace App\Controller;

use App\Entity\DataModuleIOT;
use App\Entity\ModuleIOT;
use App\Entity\TypeModuleIOT;
use App\Form\TypeModuleIOTType;
use App\Form\ModuleIOTType;
use App\Repository\TypeModuleIOTRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/moduleiot", name="app_moduleiot_")
 */
class ModuleIOTController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(TypeModuleIOTRepository $typeModuleIOTRepository): Response
    {
        $selectTypes = $typeModuleIOTRepository->findAll();

        return $this->render('module_iot/module_iot.html.twig', [
            'selectTypes' => $selectTypes
        ]);
    }
    
    /**
     * @Route("/new", name="new")
     * @Route("/{id}/update", name="update")
     */
    public function moduleIOTForm(
        Request $request,
        ModuleIOT $moduleIOT = null,
        TypeModuleIOTRepository $typeModuleIOTRepository,
        EntityManagerInterface $em
        ): Response
    {

        $type = null;

        if($moduleIOT === null){
            $moduleIOT = new ModuleIOT();
            $typeModuleIOT = $typeModuleIOTRepository->find(1);
            $type = 'add';
        } else {
            $type = 'edit';
            $typeModuleIOT = $moduleIOT->getType();
        }

        $form = $this->createForm(ModuleIOTType::class,$moduleIOT, [
            'typeModuleIOT' => $typeModuleIOT
        ]);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $moduleIOT->prePersist();
            $em->persist($moduleIOT);
            $em->flush();

            return $this->redirectToRoute('app_moduleiot_index');
        }


        return $this->renderForm('module_iot/form/form_module_iot.html.twig', [
            'form' => $form,
            'moduleIOT' => $moduleIOT,
            'type' => $type
        ]);
    }

    /**
     * @Route("/type/new", name="type_new")
     * @Route("/type/{id}/update", name="type_update")
     */
    public function typeModuleIOTForm(
        Request $request,
        TypeModuleIOT $typeModuleIOT = null,
        EntityManagerInterface $em
        ): Response
    {

        $type = null;

        if($typeModuleIOT === null){
            $typeModuleIOT = new TypeModuleIOT();
            $type = 'add';
        } else {
            $type = 'edit';
        }

        $form = $this->createForm(TypeModuleIOTType::class,$typeModuleIOT, [
            'type' => $type
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $typeModuleIOT->prePersist();
            $em->persist($typeModuleIOT);
            $em->flush();

            return $this->redirectToRoute('app_moduleiot_index');
        }


        return $this->renderForm('module_iot/form/form_type_module_iot.html.twig', [
            'form' => $form,
            'typeModuleIOT' => $typeModuleIOT,
            'type' => $type
        ]);
    }

    /**
     * @Route("/getdata/{id}", name="getData")
     */
    public function getData(
        ModuleIOT $moduleIOT, 
        SerializerInterface $serializer
    ): JsonResponse
    {
        $json = $serializer->serialize($moduleIOT,'json',['groups' => 'data_IOT']);
        
        return new JsonResponse($json,Response::HTTP_OK,[],true);
    }

    /**
     * @Route("/generatedata/{id}", name="generateData")
     */
    public function generateData(
        ModuleIOT $moduleIOT, 
        EntityManagerInterface $em,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $typeModuleIOT = $moduleIOT->getType();
        $dataModuleIOT = new DataModuleIOT();
        $dataModuleIOT->setModule($moduleIOT);
        $dataModuleIOT->setData1(intval(round(mt_rand(4,10)/10)));
        if($typeModuleIOT->getDataName2() != null){
            $dataModuleIOT->setData2(mt_rand(600,700)/10);
        }
        if($typeModuleIOT->getDataName3() != null){
            $dataModuleIOT->setData3(mt_rand(200,800)/10);
        }
        if($typeModuleIOT->getDataName4() != null){
            $dataModuleIOT->setData4(mt_rand(700,800)/10);
        }
        if($typeModuleIOT->getDataName5() != null){
            $dataModuleIOT->setData5(mt_rand(200,400)/10);
        }
        $dataModuleIOT->prePersist();

        $em->persist($dataModuleIOT);
        $em->flush();

        $json = $serializer->serialize($dataModuleIOT,'json',['groups' => 'data_IOT_only']); 
        
        return new JsonResponse($json,Response::HTTP_OK,[],true);
    }
    /**
     * @Route("/reset_module_data/{id}", name="reset_module_data")
     */
    public function resetModuleData(ModuleIOT $moduleIOT, EntityManagerInterface $em): Response
    {
        $data = $moduleIOT->getDataModuleIOTs();

        foreach ($data as $value) {
            $em->remove($value);
        }

        $em->flush();

        return new JsonResponse([
            'status' => true
        ]);
    }

    /**
     * @Route("/delete_type/{id}", name="deleteType")
     */
    public function deleteType(ModuleIOT $moduleIOT, EntityManagerInterface $em): Response
    {
        $typeModuleIOT = $moduleIOT->getType();
        $em->remove($typeModuleIOT);
        $em->flush();
        return new JsonResponse([
            'status' => true
        ]);
    }

    /**
     * @Route("/delete_module/{id}", name="deleteModule")
     */
    public function deleteModule(ModuleIOT $moduleIOT, EntityManagerInterface $em): Response
    {
        $em->remove($moduleIOT);
        $em->flush();
        return new JsonResponse([
            'status' => true
        ]);
    }
}

