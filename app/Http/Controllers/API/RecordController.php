<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Entity;
use App\Models\Record;
use App\Repositories\RecordRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class RecordController extends Controller
{
    public function __construct(private RecordRepository $recordRepository)
    {
    }

    public function index(Entity $entity,Request $request): JsonResponse
    {
        $filters["entity_id"] = $entity->id;
        $records = $this->recordRepository->get($filters);
        return response()->json(['records' => $records], 200);
    }

    public function store(Entity $entity,StoreRecordRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $data["data"] = json_encode($validated);
        $data["entity_id"] = $entity->id;
        $this->recordRepository->store($data);
        return response()->json(['message' => Lang::get('messages.process.create')], 200);
    }

    public function show(Record $record):JsonResponse
    {
        $record = $this->recordRepository->show($record->id,false,[],"id");
        return response()->json(['record' => $record], 200);
    }


    public function update(UpdateRecordRequest $request,Entity $entity, Record $record):JsonResponse
    {
        $validated = $request->validated();
        $data["data"] = json_encode($validated);
        $this->recordRepository->update($record->id, $data,"id");
        return response()->json(['message' => Lang::get('messages.process.update')], 200);
    }

    public function destroy(Record $record): JsonResponse
    {
        $this->recordRepository->delete($record->id,"id");
        return response()->json(['message' => Lang::get('messages.process.delete')], 200);
    }
}
