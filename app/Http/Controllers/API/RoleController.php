<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected $repository;

    /**
     * Load default class depedencies
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @OA\GET(
     *     path="/api/v1/roles",
     *     tags={"role"},
     *     summary="List data role.",
     *     description="Get All data Role",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @Oa\Items(
     *                         allOf={
     *                             @OA\Schema(ref="#/components/schemas/Role")
     *                         }
     *                     ) 
     *                 )
     *             )
     *         )
     *     )
     * )
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index()
    {
        $roles = $this->repository->getAll();

        return RoleResource::collection($roles);
    }

    /**
     * @OA\GET(
     *     path="/api/v1/roles/{rolesId}",
     *     tags={"role"},
     *     summary="Get role by ID",
     *     description="Return single role data",
     *     @OA\Parameter(
     *         name="rolesId",
     *         in="path",
     *         description="ID of role to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @Oa\Items(
     *                         allOf={
     *                             @OA\Schema(ref="#/components/schemas/Role")
     *                         }
     *                     ) 
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found"
     *     ),
     * )
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show($rolesId)
    {
        $role = $this->repository->getByID($rolesId);

        return new RoleResource($role);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/roles/create",
     *     tags={"role"},
     *     summary="Add new Role",
     *     description="Adding new role data",
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="position",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Missing role parameter"
     *     ),
     * )
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:active,inactive',
                'position' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                'data' => null,
                'message' => $validator->messages()->first(),
                'errors' => null,
                'status' => 422
                ], 422
            );
        }

        $role = $this->repository->store($request);

        return new RoleResource($role);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/roles/{rolesId}",
     *     tags={"role"},
     *     summary="Edit Role",
     *     description="Update role data",
     *     @OA\Parameter(
     *         name="rolesId",
     *         in="path",
     *         description="ID of role post return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="position",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Missing role parameter"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found."
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID Role"
     *     ),
     * )
     *
     */
    public function edit(Request $request, $rolesId)
    {
        $validator = Validator::make(
            $request->all(), [
                'user_id' => 'required|exists:users,id',
                'status' => 'required|in:active,inactive',
                'position' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                'data' => null,
                'message' => $validator->messages()->first(),
                'errors' => null,
                'status' => 422
                ], 422
            );
        }

        $role = $this->repository->getByID($rolesId);

        if (empty($role)) {
            return response()->json(
                [
                    'data' => null,
                    'message' => 'Role not found.',
                    'errors' => null,
                    'status' => 404
                ], 404
            );
        }

        $updateRole = $this->repository->update($rolesId, $request);

        return new RoleResource($updateRole);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/roles/{rolesId}",
     *     tags={"role"},
     *     summary="Delete Role by ID",
     *     description="Delete role data",
     *     @OA\Parameter(
     *         name="rolesId",
     *         in="path",
     *         description="ID of role post return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Role not found."
     *     ),
     * )
     */
    public function destroy($rolesId)
    {
        $this->repository->delete($rolesId);

        return response()->json(
            [
                'data' => null,
                'message' => 'Deleted data',
                'errors' => null,
                'status' => 200
            ], 200
        );
    }
}
