<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Stripe\Entities\StripeCard;

class StripeController extends Controller
{

    /**
     *
     * @OA\Get(
     * path="/stripe/card-list",
     * operationId="card list",
     * tags={"Stripe"},
     * summary="card list",
     * description="card list",
     * security={{ "sanctum": {} }},
     *
     * @OA\Response(
     *    response=400,
     *    description="Validator Error"
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Authentication Error",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Something went wrong"),
     *      )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    ),
     * )
     */

    public function cardList(Request $request)
    {
        $card = StripeCard::get();

        if (count($card) > 0) {
            return response()->json([
                'message' => 'Card detail',
                'details' => $card
            ], 200);
        } else {
            return response([
                'message' => 'Card not found!'
            ], 400);
        }
    }
}
