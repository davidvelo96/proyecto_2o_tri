<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;


class ProductController extends AbstractController
{
    // /**
    //  * @Route("/product", name="product")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('product/index.html.twig', [
    //         'controller_name' => 'ProductController',
    //     ]);
    // }


    // /**
    //  * @Route("/product", name="create_product")
    //  */
    // public function createProduct(ManagerRegistry $doctrine): Response
    // {
    //     $entityManager = $doctrine->getManager();

    //     $product = new Product();
    //     $product->setName('Keyboard');
    //     $product->setPrice(1999);
    //     $product->setDescription('Ergonomic and stylish!');

    //     // tell Doctrine you want to (eventually) save the Product (no queries yet)
    //     $entityManager->persist($product);

    //     // actually executes the queries (i.e. the INSERT query)
    //     $entityManager->flush();

    //     return new Response('Saved new product with id ' . $product->getId());
    // }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No hay product found for id ' . $id
            );
        }

        return new Response('Check out this great product: ' . $product->getName());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/produc/", name="product_showe")
     */
    public function showe(ProductRepository $productRepository, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);

        // $product = $productRepository->find($id);

        $product = $repository->findOneBy([
            'name' => 'Keyboard',
            'price' => 1999,
        ]);
        return new Response('Check out this great product: ' . $product->getName());
    }


    /**
     * @Route("/muestra/{id}", name="muestra")
     */
    public function muestra(Product $product): Response
    {
        // use the Product!
        // ...
        return new Response('El producto "' . $product->getName() . '" tiene un precio de "' . $product->getPrice().'€"');
    }

    /**
     * @Route("/edit/{id}")
     */
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $product->setName('Teclado gaming 12542aa');
        $product->setPrice(544);

        $entityManager->flush();

        return $this->redirectToRoute('muestra', [
            'id' => $product->getId()
        ]);
    }



    /**
     * @Route("/valida", name="valida")
     */
    public function createProduct(ValidatorInterface $validator): Response
    {
        $product = new Product();
        // This will trigger an error: the column isn't nullable in the database
        $product->setName("null");
        // This will trigger a type mismatch error: an integer is expected
        $product->setPrice("dfsd");

        // ...

        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        // ...
    }


    /**
     * @Route("/creaCatProd", name="pcate")
     */
    public function creaCatPro(ManagerRegistry $doctrine): Response
    {
        $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Teclado logitech b4v');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomico y con mucho estilo!');

        // relates this product to the category
        $product->setCategory($category);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($category);
        $entityManager->persist($product);
        $entityManager->flush();

        return new Response(
            'Saved new product with id: ' . $product->getId()
                . ' and new category with id: ' . $category->getId()
        );
    }


    /**
     * @Route("/muestraCatProd/{id}", name="pcate")
     */
    public function showCate(ManagerRegistry $doctrine, int $id): Response
    {
        $product = $doctrine->getRepository(Product::class)->find($id);

        $categoryName = $product->getCategory()->getName();

        return new Response(
            'Esta es la categoria del producto' . $id . " -- " . $categoryName
        );
    }


    /**
     * @Route("/muestraProdCat/{id}", name="catprod")
     */
    public function showProducts(ManagerRegistry $doctrine, int $id): Response
    {
        $category = $doctrine->getRepository(Category::class)->find($id);

        $products = $category->getProducts();

        return $this->render('cat.html.twig', [
            'productos' => $products,
            'categorias' => $category
        ]);
    }
}



//kernel evento manejador de eventos not found, atraparlo y manejar evento 
