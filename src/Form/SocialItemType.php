<?php

namespace App\Form;

use App\Entity\SocialItem;
use App\Enum\SocialItemIconEnum;
use App\Form\FormUtils\FormTypeUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SocialItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('link', UrlType::class)
            ->add('icon', ChoiceType::class, [
                'choices' => FormTypeUtils::makeChoices(
                    array_map(
                        fn(SocialItemIconEnum $itemIconEnum) => $itemIconEnum->value,
                        SocialItemIconEnum::cases()
                    )
                )
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SocialItem::class,
        ]);
    }
}
