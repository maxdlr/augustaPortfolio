<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\BedType;
use App\Entity\Conversation;
use App\Entity\Lodging;
use App\Entity\Message;
use App\Entity\Reservation;
use App\Entity\ReservationStatus;
use App\Entity\Review;
use App\Entity\User;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use ReflectionException;
use ReflectionMethod;

class VueDataFormatter
{
    private static array $vueObject = [];

    /**
     * @throws ReflectionException
     */
    public static function makeVueObjectOf(array $entities, array $properties): static
    {
        self::$vueObject = array_map(function (object $object) use ($entities, $properties) {
            assert(get_class($object) === get_class($entities[0]));
            return self::makeVueObject($object, $properties);
        }, $entities);

        return new static;
    }

    public function regroup(string $property): static
    {
        self::$vueObject = array_unique(
            array_map(fn(array $object) => $object[$property], self::$vueObject), SORT_REGULAR
        );
        sort(self::$vueObject);
        return new static;
    }

    public function get(): array
    {
        return self::$vueObject;
    }

    /**
     * @throws ReflectionException
     */
    private static function makeVueObject(object $object, array $properties): array
    {
        $vueObject = [];
        $objectFqcn = get_class($object);
        $allProperties = ClassBrowser::findAllProperties($objectFqcn);

        foreach ($allProperties as $property) {
            if (in_array($property->getName(), $properties)) {
                $getter = self::findGetterMethod($objectFqcn, $property->getName());
                $value = $object->{$getter->getName()}();
                $vueObject[$property->getName()] = self::formatValue($value);
            }
        }

        return self::sortVueObject($vueObject, $properties);
    }

    /**
     * @throws ReflectionException
     */
    private static function findGetterMethod(string $objectFqcn, string $propertyName): ReflectionMethod
    {
        $getter = ClassBrowser::findGetter($objectFqcn, $propertyName);
        assert($getter instanceof ReflectionMethod);
        return $getter;
    }

    /**
     * @throws ReflectionException
     */
    private static function formatValue(mixed $value): mixed
    {
        return match (true) {
            $value instanceof DateTimeInterface => $value->format('Y-m-d'),
            $value instanceof Collection => self::formatCollection($value),
            default => $value
        };
    }

    /**
     * @throws ReflectionException
     */
    private static function formatCollection(Collection $collection): array
    {
        return array_map(function ($object) {
            $collectionProperty = self::getCollectionProperty($object);
            return self::makeVueObject($object, $collectionProperty);
        }, $collection->toArray());
    }

    private static function getCollectionProperty(object $object): ?array
    {
        return match (true) {
            default => null
        };
    }

    private static function sortVueObject(array $vueObject, array $properties): array
    {
        $sortedVueObject = [];
        foreach ($properties as $property) {
            $sortedVueObject[$property] = $vueObject[$property];
        }
        return $sortedVueObject;
    }
}
