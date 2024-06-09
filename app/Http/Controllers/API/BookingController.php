<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Entities\Booking;
use PhpParser\Node\Stmt\Else_;

class BookingController extends Controller
{
    /**
     *
     * @OA\Post(
     * path="/booking/driver-booking-list",
     * operationId="all bookings",
     * tags={"Booking"},
     * summary="all bookings",
     * description="all bookings",
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

    public function index()
    {
        $bookings = Booking::where('driver_id', Auth::user()->id)->get();

        if (count($bookings) > 0) {
            return response()->json([
                'message' => 'driver booking list',
                'details' => $bookings
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }

    /**
     *
     * @OA\Post(
     * path="/booking/booking-detail",
     * operationId="booking detail",
     * tags={"Booking"},
     * summary="booking detail",
     * description="booking detail",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1"),
     *           ),
     *       ),
     *   ),
     *
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

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        $booking = Booking::find($request->id);

        if (!empty($booking)) {
            return response()->json([
                'message' => 'new booking',
                'details' => $booking
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }

    /**
     *
     * @OA\Post(
     * path="/booking/customer-booking-list",
     * operationId="customer booking list",
     * tags={"Booking"},
     * summary="customer booking list",
     * description="customer booking list",
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

    public function customerBookingList(Request $request)
    {
        $bookings = Booking::where('created_by_id', Auth::user()->id)->get();

        if (!empty($bookings)) {
            return response()->json([
                'message' => 'customer booking list',
                'details' => $bookings
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }


    /**
     *
     * @OA\Post(
     * path="/booking/vehicle-detail",
     * operationId="vehicle detail",
     * tags={"Booking"},
     * summary="vehicle detail",
     * description="vehicle detail",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1"),
     *           ),
     *       ),
     *   ),
     *
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

    public function vehicleDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        $detail = VehicleType::find($request->id);

        if (!empty($booking)) {
            return response()->json([
                'message' => 'vehicle detail',
                'details' => $detail
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }


    /**
     *
     * @OA\Get(
     * path="/booking/fare-estimate",
     * operationId="fare estimate",
     * tags={"Booking"},
     * summary="fare estimate",
     * description="fare estimate",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1"),
     *              @OA\Property(property="distance", type="integer", example="1"),
     *           ),
     *       ),
     *   ),
     *
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

    public function fareEstimate()
    {
        $detail = VehicleType::get();

        if (!empty($detail)) {
            return response()->json([
                'message' => 'vehicle detail',
                'details' => $detail
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }

    /**
     *
     * @OA\Get(
     * path="/booking/fare-estimate",
     * operationId="fare estimate",
     * tags={"Booking"},
     * summary="fare estimate",
     * description="fare estimate",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer", example="1"),
     *           ),
     *       ),
     *   ),
     *
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

    public function rideRequest(Request $request)
    {
        $data = [];
        $model = new Booking();

        $driver = User::where('id', $request->id)->first();

        if (!empty($driver)) {
            $model->state_id = Booking::STATE_INPROGRESS;
            $model->type_id = 1;
            $model->from_latitude = $driver->latitude;
            $model->from_longitude = $driver->longitude;
            $model->from_address = $driver->address;
            $model->accepted_by_id = $driver->id;

            if ($model->save()) {
                $this->setStatus(200);
                $data['detail'] = $model->asJson(false);
                $data['message'] = 'Request added successfully';
                Notification::create([
                    'model' => $model,
                    'to_user_id' => $driver->id,
                    'type_id' => Notification::TYPE_REQUEST_SEND,
                    'title' => 'Ride request has been added',
                    'created_by_id' => Auth::user()->id
                ], false, true);
            } else {
                $data['message'] = 'Data not found!';
            }
        } else {
            $data['message'] = 'Driver already has a ride .';
        }

        return response()->json(['details' => $data], 200);
    


        if (!empty($bookings)) {
            return response()->json([
                'message' => 'customer booking list',
                'details' => $bookings
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }
}
