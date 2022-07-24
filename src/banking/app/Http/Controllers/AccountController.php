<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validations\AccountValidation;
use App\Repositories\Concrete\AccountRepository;
use App\Traits\ApiResponseTrait;

class AccountController extends Controller
{
    use ApiResponseTrait;

    private AccountValidation $validation;

    public function __construct(AccountValidation $AccountValidation)
    {
        $this->validation = $AccountValidation;
    }

    /**
     * @OA\POST(
     *     path="/api/v1/accounts",
     *     summary="Create Account Data",
     *     description="Create Account Data",
     *     tags={"Account"},
     *     @OA\Parameter(
     *          name="owner",
     *          description="Account Owner Name",
     *          required=true,
     *          example="Bartu",
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="currency_id",
     *          description="Currency ID",
     *          required=true,
     *          example=1,
     *          in="query"
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
    */
    public function create(Request $request)
    {
        try {
            return $this->validation->create($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @OA\GET(
     *     path="/api/v1/accounts",
     *     summary="List Account Data",
     *     description="List Account Data",
     *     tags={"Account"},
     *     @OA\Parameter(
     *          name="currency_id",
     *          description="Currency ID",
     *          required=true,
     *          example=1,
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="paginate",
     *          description="Paginate",
     *          required=true,
     *          example=15,
     *          in="query"
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
    */
    public function list(Request $request)
    {
        try {
            return $this->validation->list($request);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * @OA\DELETE(
     *     path="/api/v1/accounts/{AccountID}",
     *     summary="Get Account Data",
     *     description="Get Account Data",
     *     tags={"Account"},
     *     @OA\Parameter(
     *          name="AccountID",
     *          description="Account ID",
     *          required=true,
     *          example=12,
     *          in="path"
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
    */
    public function delete($AccountID, AccountRepository $accountRepository)
    {
        try {
            return $accountRepository->delete($AccountID);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
