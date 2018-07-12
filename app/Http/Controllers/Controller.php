<?php

namespace App\Http\Controllers;

use App\Exceptions\OrigamiException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\TransformerAbstract;

class Controller extends BaseController
{
    protected $type;

    /**
     * @param Request $request
     * @param array $params
     * @param array $messages
     * @param array $customAttributes
     * @return array|void
     */
    public function validate(Request $request, array $params, array $messages = [], array $customAttributes = [])
    {
        try {
            parent::validate($request, $params);
        } catch (ValidationException $e) {
            $exception = new OrigamiException();
            $exception->setStatusCode(400);

            foreach ($e->validator->errors()->messages() as $key => $error)
                $exception->addError($error[0], 0, $key, 400);

            throw $exception;
        }
    }

    /**
     * Create the response for an item.
     *
     * @param  mixed $item
     * @param  \League\Fractal\TransformerAbstract $transformer
     * @param  int $status
     * @param  array $headers
     * @return Response
     */
    protected function item($item, TransformerAbstract $transformer, $status = 200, array $headers = [])
    {
        $resource = new item($item, $transformer, $this->type);

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    /**
     * Create the response for a collection.
     *
     * @param  mixed $collection
     * @param  \League\Fractal\TransformerAbstract $transformer
     * @param  int $status
     * @param  array $headers
     * @return Response
     */
    protected function collection($collection, TransformerAbstract $transformer, $status = 200, array $headers = [])
    {
        $resource = new Collection($collection, $transformer, $this->type);

        return $this->buildResourceResponse($resource, $status, $headers);
    }

    /**
     * Create the response for a resource.
     *
     * @param  \League\Fractal\Resource\ResourceAbstract $resource
     * @param  int $status
     * @param  array $headers
     * @return Response
     */
    protected function buildResourceResponse(ResourceAbstract $resource, $status = 200, array $headers = [])
    {
        $fractal = app('League\Fractal\Manager');
        $fractal->setSerializer(new JsonApiSerializer(env('APP_URL')));

        if (isset($_GET['include']))
            $fractal->parseIncludes($_GET['include']);

        return response()->json(
            $fractal->createData($resource)->toArray(),
            $status,
            $headers
        );
    }
}
