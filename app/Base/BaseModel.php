<?php

namespace App\Base;

use DB;
use App\Helpers\Helpers;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class BaseModel
 *
 * @mixin Eloquent
 *
 * @package App\Base
 */
class BaseModel extends Model
{
    protected $guarded = [];

    protected $customDefinitions = [

    ];

    /**
     * @return $this
     */
    public function loadRelationsForDetailsResponse()
    {
        return $this;
    }

    public function fields($fields = [], $prefixes = [])
    {
        foreach (DB::getSchemaBuilder()->getColumnListing($this->getTable()) as $fieldName) {
            $prefix   = ! empty($prefixes) ? implode('.', $prefixes) . '.' : '';
            $fields[] = "{$prefix}{$fieldName}";
        }

        $reflector = new \ReflectionClass($this);

        foreach ($reflector->getMethods() as $reflectionMethod) {
            $returnType = $reflectionMethod->getReturnType();
            if (
                $returnType !== null &&
                $returnType->getName() === BelongsTo::class
            ) {
                $parentModel = $reflectionMethod->invoke($this)->getRelated();
                if ($parentModel instanceof BaseModel) {
                    $prefixes[] = $reflectionMethod->name;
                    $fields     = $parentModel->fields($fields, $prefixes);
                    array_pop($prefixes);
                }
            }
        }

        if (is_array($this->customDefinitions) && ! Helpers::isAssoc($this->customDefinitions)) {
            $fields = array_merge(
                array_map(function($definition) use($prefixes) {
                $prefix   = ! empty($prefixes) ? implode('.', $prefixes) . '.' : '';
                return "{$prefix}{$definition}";
            }, $this->customDefinitions), $fields);
        } else {
            $modelName = class_basename($this);
            throw new Exception("Model {$modelName} should have the customDefinitions property defined as an associative array.");
        }

        return $fields;
    }

    /**
     * Traverse through model for a value
     *
     * @param $value
     *
     * @return string
     */
    public function traverseForValue($value)
    {
        $traversedValue = $this;

        foreach (explode('.', $value) as $nestedProperty) {
            if (! preg_match('/^[a-zA-Z]+/', $nestedProperty)) {
                $modelName = class_basename($this);
                throw new Exception("Invalid traversable key given [{$value}] for {$modelName}");
            }

            if ($traversedValue === null) {
                $this->throwTraverseError($value);
            }

            if ($traversedValue instanceof Collection) {
                if ($nestedProperty !== '*') {
                    $this->throwTraverseError($value);
                }

                if ($traversedValue->isEmpty()) {
                    $this->throwTraverseError($value);
                }
                // if not an empty collection, assign the first item of the collection and continue
                $traversedValue = $traversedValue[0];

                continue;
            }

            $traversedValue = $traversedValue->{$nestedProperty};
        }

        return $traversedValue;
    }

    private function throwTraverseError($value)
    {
        $modelName = class_basename($this);
        throw new Exception("Could not traverse through {$modelName} with the value {$value}");
    }
}
