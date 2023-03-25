<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOperatorRequest;
use App\Http\Requests\UpdateOperatorRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class OperatorController extends Controller
{

    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $search = $request->get("search", false);
        $records = $this->userRepository->getWithRole("operator",[],$search );
        return response()->json(['records' => $records], 200);
    }

    public function store(StoreOperatorRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $record = $this->userRepository->store($validated);
        $this->userRepository->assignRole($record, "operator");
        return response()->json(['message' => Lang::get('messages.process.create')], 200);
    }

    public function show(User $operator):JsonResponse
    {
        $record = $this->userRepository->show($operator->slug);
        return response()->json(['record' => $record], 200);
    }


    public function update(UpdateOperatorRequest $request, User $operator):JsonResponse
    {
        $validated = $request->validated();
        $this->userRepository->update($operator->slug, $validated);
        return response()->json(['message' => Lang::get('messages.process.update')], 200);
    }

    public function destroy(User $operator): JsonResponse
    {
        $this->userRepository->delete($operator->slug);
        return response()->json(['message' => Lang::get('messages.process.delete')], 200);
    }
}
