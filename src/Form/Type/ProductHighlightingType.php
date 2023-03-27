<?php

namespace Dotit\SyliusHighlightingPlugin\Form\Type;

use Dotit\SyliusHighlightingPlugin\Entity\ProductHighlighting;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Sylius\Component\Core\Model\Product;
use Sylius\Component\Core\Repository\ProductRepository;
use Sylius\Component\Product\Model\ProductInterface as productInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceAutocompleteChoiceType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAutocompleteChoiceType;

use Symfony\Component\Form\FormError;

class ProductHighlightingType extends AbstractResourceType
{

    public function __construct()
    {
        parent::__construct(ProductHighlighting::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('position', IntegerType::class, [
                'label' => 'Position',
            ])
            ->add('slug', TextType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.store.slug',
            ])
            ->add('description', TextType::class, [
                'label' => 'dotit_sylius_appearance_plugin.form.store.description',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('products', ProductAutocompleteChoiceType::class, [
                'label' => 'Products',
                'multiple' => true,
                'required' => true,
                'resource' => 'sylius.product',
                'choice_value' => 'code',
                'choice_name' => 'name',
                'data' => $options['data']->getProducts(),
                'data_class' => null
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'validation_groups' => function (FormInterface $form): array {
                /** @var ProductHighlighting|null $productHighlight */
                $productHighlight = $form->getData();
                if ($productHighlight) {
                    $products = $productHighlight->getProducts();
                    if (sizeof($products) < 4) {
                        $form->get('products')->addError(new FormError('Min selected products is 4'));

                    } elseif (sizeof($products) > 20) {
                        $form->get('products')->addError(new FormError('Max selected products is 20'));

                    }
                    if (!$productHighlight instanceof ProductHighlighting || null === $productHighlight->getId()) {
                        return array_merge($this->validationGroups, ['dotit_product']);
                    }
                }
                return array_merge($this->validationGroups, ['dotit_product']);
            }
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'dotit_product_highlighting';
    }
}