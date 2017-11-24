<?php

namespace APSMeetup\Http\Controllers\API\V1;

use APSMeetup\Http\Resources\ProductsResource;
use APSMeetup\Models\Product;
use Illuminate\Http\Request;
use APSMeetup\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
        return ProductsResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->product->fill($request->all());
        $this->product->save();

        $product = $this->product;
        $resource = new ProductsResource($product);

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
        return new ProductsResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \APSMeetup\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->product->fill($request->all());
        $this->product->save();

        $product = $this->product;
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

        return response()->json(['message' => 'Register deleted'], Response::HTTP_OK);
    }
}
