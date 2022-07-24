<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Validations\TransactionValidation;
use App\Traits\ApiResponseTrait;

class TransactionController extends Controller
{
    use ApiResponseTrait;

    private TransactionValidation $validation;

    public function __construct(TransactionValidation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @OA\GET(
     *     path="/api/v1/transactions",
     *     summary="List Transactions",
     *     description="List Transactions",
     *     tags={"Transaction"},
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
     *          response=200,
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
        }
        catch (Exception $e) {
            return $this->badRequestResponse($e->getMessage());
        }
    }

    /**
     * @OA\POST(
     *     path="/api/v1/transactions",
     *     summary="Create Transaction",
     *     description="Create Transaction",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *          name="from_account_id",
     *          description="Account ID",
     *          required=true,
     *          example=21,
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="to_account_id",
     *          description="Account ID",
     *          required=true,
     *          example=12,
     *          in="query"
     *     ),
     *     @OA\Parameter(
     *          name="amount",
     *          description="Amount of money",
     *          required=true,
     *          example=100,
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
        }
        catch (Exception $e) {
            return $this->badRequestResponse($e->getMessage());
        }
    }

    /**
     * @OA\PATCH(
     *     path="/api/v1/transactions/withdraws/{AccountID}",
     *     summary="Withdraw Money",
     *     description="Withdraw Money",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *          name="AccountID",
     *          description="Account ID",
     *          required=true,
     *          example=12,
     *          in="path"
     *     ),
     *     @OA\Parameter(
     *          name="amount",
     *          description="Amount of money",
     *          required=true,
     *          example=100,
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
     *          response=200,
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
     */
    public function withdraws($AccountID, Request $request)
    {
        try {
            return $this->validation->withdraws($AccountID, $request);
        }
        catch (Exception $e) {
            return $this->badRequestResponse($e->getMessage());
        }
    }

    /**
     * @OA\PATCH(
     *     path="/api/v1/transactions/deposits/{AccountID}",
     *     summary="Deposit Money",
     *     description="Deposit Money",
     *     tags={"Transaction"},
     *     @OA\Parameter(
     *          name="AccountID",
     *          description="Account ID",
     *          required=true,
     *          example=12,
     *          in="path"
     *     ),
     *     @OA\Parameter(
     *          name="amount",
     *          description="Amount of money",
     *          required=true,
     *          example=100,
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
     *          response=200,
     *          description="OK"),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request")
     * )
     */
    public function deposits($AccountID, Request $request)
    {
        try {
            return $this->validation->deposits($AccountID, $request);
        }
        catch (Exception $e) {
            return $this->badRequestResponse($e->getMessage());
        }
    }
}
