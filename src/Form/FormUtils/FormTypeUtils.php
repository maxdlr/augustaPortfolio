<?php

namespace App\Form\FormUtils;

use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use function Symfony\Component\String\u;

class FormTypeUtils
{
    static public function makeIntChoices(int $number): array
    {
        $choices = [];
        for ($i = 1; $i <= $number; $i++) {
            $iString = u($i)->toString();
            $choices[$iString] = $iString;
        }
        return $choices;
    }

    static public function makeChoices(array $choices): array
    {
        $formattedChoices = [];
        foreach ($choices as $choice) {
            $formattedChoices[$choice] = $choice;
        }
        return $formattedChoices;
    }

    static public function makeFileUploadParameters(bool $multiple = false): array
    {
        $file = new File([
            'maxSize' => '4000000k',
            'mimeTypes' => [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp',
                'image/gif'
            ],
            'mimeTypesMessage' => 'Types de ficher accepté: jpg, jpeg, png',
        ]);

        $parameters = [
            'mapped' => false,
            'required' => false
        ];

        if ($multiple === false) {
            $parameters['constraints'] = [$file];
        } else {
            $parameters['constraints'] = [new All([$file])];
            $parameters['multiple'] = true;
        }

        return $parameters;
    }
}