<?php
namespace App\GraphQL\Mutation;

use Doctrine\ORM\EntityManager;
use OverBlog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use App\Entity\Product;

class ProductMutation implements MutationInterface, AliasedInterface
{
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function createProduct(Argument $args)
	{
		$input = $args['input'];

		$product = new Product();
		$product->setName($input['name']);
		$product->setPrice($input['price']);
		$product->setSlug($input['slug']);
		$product->setDescription($input['description']);

		$this->em->persist($product);
		$this->em->flush();

		return $product;
	}

	public static function getAliases()
	{
		return [
			'createProduct' => 'create_product'
		];
	}
}