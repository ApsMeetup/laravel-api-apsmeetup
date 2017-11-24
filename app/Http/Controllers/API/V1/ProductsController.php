<?php

namespace APSMeetup\Http\Controllers\API\V1;

use APSMeetup\Http\Resources\ProductsResource;
use APSMeetup\Models\Product;
use APSMeetup\Http\Controllers\Controller;
use Illuminate\Http\Response;
use APSMeetup\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductsResource::collection($this->product->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \APSMeetup\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->product->fill($request->all());
        $this->product->save();

        $resource = new ProductsResource($this->product);

        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \APSMeetup\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $resource = new ProductsResource($product);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \APSMeetup\Http\Requests\ProductRequest $request
     * @param  \APSMeetup\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        $resource = new ProductsResource($product);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \APSMeetup\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['data' => ['message' => 'register deleted']], Response::HTTP_OK);
    }
}
