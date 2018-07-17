<?php

namespace App\Models;

use App\Exceptions\OrigamiException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @property mixed id
 */
abstract class BaseModel extends Model
{
    protected $rules = [];

    public function canBeUpdated($params)
    {
        $updatable = $this->getFillable();
        foreach ($params as $key => $value) {
            if (in_array($key, $updatable) && $this->$key != $value) {
                return true;
            }
        }
        return false;
    }

    public function isUpdated()
    {
        return !empty($this->getChanges());
    }

    public function save(array $options = [])
    {
        $this->validate();
        return parent::save($options);
    }

    public static function create(array $attributes = [])
    {
        return static::query()->create($attributes);
    }

    public static function find($id)
    {
        $model = static::query()->find($id);

        if (!$model) {
            $calledClass = get_called_class();
            $calledClass = substr($calledClass, strrpos($calledClass, "\\") + 1);
            throw new NotFoundHttpException($calledClass . ' with id ' . $id . ' not found');
        }

        return $model;
    }

    /**
     * @param $column
     * @param null $operator
     * @param null $value
     * @param string $boolean
     * @return $this
     */
    public static function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        return static::query()->where($column, $operator, $value, $boolean);
    }

    public static function orderBy($column, $direction = 'asc')
    {
        return static::query()->orderBy($column, $direction);
    }

    public static function select($columns = ['*'])
    {
        return static::query()->select($columns);
    }

    protected function validate()
    {
        $rules = array_map(function ($str) {
            preg_match('/{(.*?)}/', $str, $match);
            return count($match) > 0 ? str_replace('{' . $match[1] . '}', $this->id, $str) : $str;
        }, $this->rules);

        $validator = Validator::make($this->toArray(), $rules);

        if ($validator->fails()) {
            $exception = new OrigamiException();
            foreach ($validator->errors()->getMessages() as $error) {
                \Log::info(print_r('[ValidateModel] : ' . $error[0], true));
                $exception->addError($error[0]);
            }
            throw $exception;
        }

        return true;
    }


}
