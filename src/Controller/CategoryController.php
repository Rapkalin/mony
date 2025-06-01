<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{

    /*
     * TODO: delete category
     * if ($category->isDefault()) {
            throw new AccessDeniedHttpException('Default categories cannot be modified or deleted.');
        }
     */

    
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
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
            $category->setUser($this->getUser());
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
