<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Entity\Category;
use App\Form\ExpenseFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Expense;

#[AllowDynamicProperties] class ExpenseController extends BaseController
{
    private UserInterface $user;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    #[Route('/addexpense', name: 'add_expense', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        // usually you'll want to make sure the user is authenticated first,
        // see "Authorization" below
        $this->denyAccessUnlessGranted(
            'IS_AUTHENTICATED_FULLY',
            'Access denied!',
            'Please login first to access this page'
        );

        $this->user = $this->getUser(); // returns your User object, or null if the user is not authenticated

        $expense = new Expense();
        $form = $this->createForm(ExpenseFormType::class, $expense, [
            'attr' => ['class' => 'form form-expense'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->get('category')->getData();
            $expense->addCategory($category);
            $expense->setUser($this->user);
            $this->entityManager->persist($expense);
            $this->entityManager->flush();

            return $this->redirectToRoute('add_expense');
        }

        return $this->render('expense/form.html.twig', [
            'user' => $this->user,
            'expenseForm' => $form,
        ]);
    }

    #[Route('/addCategoryAjax', name: 'add_category_ajax', methods: ['POST'])]
    public function addCategoryAjax(Request $request): JsonResponse
    {
        $categoryName = trim($request->request->get('newCategory'));

        if (!$categoryName) {
            return new JsonResponse(['error' => 'Category name is empty'], 400);
        }

        $categoryRepo = $this->entityManager->getRepository(Category::class);

        $existing = $categoryRepo->findOneBy(['name' => $categoryName]);
        if ($existing) {
            return new JsonResponse(['error' => 'This category already exists!'], 400);
        } else {
            $category = new Category();
            $category->setName($categoryName);
            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }

        $allCategories = $categoryRepo->findAll();

        $data = array_map(fn($cat) => [
            'id' => $cat->getId(),
            'name' => $cat->getName(),
        ], $allCategories);

        return new JsonResponse($data);
    }
}
