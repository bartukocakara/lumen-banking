<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Repositories\Concrete\EntryRepository;

class EntryController extends Controller
{
    use ApiResponseTrait;

    /**
     * @var EntryRepository
     */
    private EntryRepository $repository;

    public function __construct(EntryRepository $entryRepository)
    {
        $this->repository = $entryRepository;
    }

    /**
     * @OA\GET(
     *     path="/api/v1/entries/synchronisation",
     *     summary="Syncronize multiple databases",
     *     description="Syncronize multiple databases",
     *     tags={"Entries"},
     *     @OA\Response(
     *          response=200,
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
     */
    public function synchronisation()
    {
        try {
            return $this->repository->synchronisation();
        } catch (Exception $e) {
            return $this->badRequestResponse($e->getMessage());
        }
    }
}
