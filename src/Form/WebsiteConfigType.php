<?php

namespace App\Form;

use App\Entity\Media;
use App\Entity\WebsiteConfig;
use App\Enum\MediaTypeEnum;
use App\Form\FormUtils\FormTypeUtils;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebsiteConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('media', FileType::class,
                [
                    ...FormTypeUtils::makeFileUploadParameters(),
                    'required' => false,
                ])
            ->add('seoImg', EntityType::class, [
                'class' => Media::class,
                'choices' => $options['illustrations'],
                'choice_label' => 'mediaPath',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WebsiteConfig::class,
            'illustrations' => null
        ]);
    }
}
