<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Repositories\AttributeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class AttributeController extends Controller
{
    public function __construct(private AttributeRepository $attributeRepository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->get("search", false);
        $records = $this->attributeRepository->get();
        return response()->json(['records' => $records], 200);
    }

    public function store(StoreAttributeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $this->attributeRepository->store($validated);
        return response()->json(['message' => Lang::get('messages.process.create')], 200);
    }

    public function show(Attribute $attribute):JsonResponse
    {
        $record = $this->attributeRepository->show($attribute->slug);
        return response()->json(['record' => $record], 200);
    }


    public function update(UpdateAttributeRequest $request, Attribute $attribute):JsonResponse
    {
        $validated = $request->validated();
        $this->attributeRepository->update($attribute->slug, $validated);
        return response()->json(['message' => Lang::get('messages.process.update')], 200);
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        $this->attributeRepository->delete($attribute->slug);
        return response()->json(['message' => Lang::get('messages.process.delete')], 200);
    }
}
