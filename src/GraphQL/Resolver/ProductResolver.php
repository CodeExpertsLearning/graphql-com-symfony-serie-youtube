<?php
namespace App\GraphQL\Resolver;


use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ProductResolver implements ResolverInterface, AliasedInterface
{
	/**
	 * @var EntityManager
	 */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function resolve(Argument $argument)
	{
		$product = $this->em->getRepository('App:Product')->find($argument['id']);

		return $product;
	}

	public static function getAliases()
	{
		return [
			'resolve' => 'Product'
		];
	}
}