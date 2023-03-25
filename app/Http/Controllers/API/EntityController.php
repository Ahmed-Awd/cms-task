<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignOrRemoveAttributeRequest;
use App\Http\Requests\StoreEntityRequest;
use App\Http\Requests\UpdateEntityRequest;
use App\Models\Entity;
use App\Repositories\EntityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class EntityController extends Controller
{


    public function __construct(private EntityRepository $entityRepository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->get("search", false);
        $records = $this->entityRepository->get();
        return response()->json(['records' => $records], 200);
    }

    public function store(StoreEntityRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $this->entityRepository->store($validated);
        return response()->json(['message' => Lang::get('messages.process.create')], 200);
    }

    public function show(Entity $entity):JsonResponse
    {
        $record = $this->entityRepository->show($entity->slug,false,["attributes"]);
        return response()->json(['record' => $record], 200);
    }


    public function update(UpdateEntityRequest $request, Entity $entity):JsonResponse
    {
        $validated = $request->validated();
        $this->entityRepository->update($entity->slug, $validated);
        return response()->json(['message' => Lang::get('messages.process.update')], 200);
    }

    public function destroy(Entity $entity): JsonResponse
    {
        $this->entityRepository->delete($entity->slug);
        return response()->json(['message' => Lang::get('messages.process.delete')], 200);
    }

    public function assignOrRemoveAttribute(AssignOrRemoveAttributeRequest $request,$type,Entity $entity): JsonResponse
    {
        $validated = $request->validated();
        if($type == "assign"){
            $this->entityRepository->assignAttribute($entity,$validated["attribute"]);
            return response()->json(['message' => Lang::get('messages.process.update')], 200);
        }
        if ($type == "remove"){
            $this->entityRepository->removeAttribute($entity->id,$validated["attribute"]);
            return response()->json(['message' => Lang::get('messages.process.delete')], 200);
        }
        return response()->json(['message' => Lang::get('messages.process.update')], 200);
    }
}
