<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{

    #[Route('/customer', name: 'customer_list')]
    public function index()
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $this->render('customer/index.html.twig', array('customers' => $customers));
    }


    #[Route('/customer/new', name: 'new_customer')]
    public function create(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush($customer);

            return $this->redirectToRoute('customer_list');
        }

        return $this->render('customer/new.html.twig', array('form' => $form->createView()));

    }

    #[Route('/customer/{id}', name: 'customer_show')]
    public function show($id): \Symfony\Component\HttpFoundation\Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        return $this->render('customer/customer.html.twig', array('customer' => $customer));
    }

    #[Route('/customer/edit/{id}', name: 'edit_customer')]
    public function edit(Request $request, $id): \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        $customer = new Customer();
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush($customer);

            return $this->redirectToRoute('customer_list');
        }

        return $this->render('customer/edit.html.twig', array('form' => $form->createView()));

    }

    #[Route('/customer/delete/{id}', name: 'delete')]
    public function delete(Request $request, $id)
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        $this->getDoctrine()->getManager()->remove($customer);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('customer_list');
    }
}
