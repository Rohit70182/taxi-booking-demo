<?php

namespace App\Http\Controllers\API;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\DeviceDetail;
use App\Models\EmergencyContact;
use App\Models\Notification;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserDetail;
use Exception;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Booking\Entities\Booking;
use Modules\Page\Entities\Page;
use Modules\Rating\Entities\Rating;
use Modules\Settings\Entities\Setting;

class UserController extends Controller
{

    /**
     *
     * @OA\Post(
     * path="/user/register",
     * operationId="userRegister",
     * tags={"User"},
     * summary="user register",
     * description="user register",
     * security={{ "basicAuth": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"first_name","email","password","last_name", "role","contact_no"},
     *              @OA\Property(property="first_name", type="string", format="name", example="test"),
     *              @OA\Property(property="last_name", type="string", format="name", example="test"),
     *              @OA\Property(property="role", type="integer", format="role", example="1"),
     *              @OA\Property(property="contact_no", type="string", format="contact no", example="9797979797"),
     *              @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="password", type="string", format="password", example="password2"),
     *              @OA\Property(property="referral_code", type="string", format="code"),
     *           ),
     *       ),
     *   ),
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
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="User register successfully"),
     *          @OA\Property(property="user", type="string", example="User details"),
     *      )
     *     ),
     * )
     */

    public function register(Request $request)
    {
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'first_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'last_name' => 'required|string',
            'role' => 'required',
            'contact_no' => 'required',
            'password' => ['required', 'string', 'min:8']
        ]);


        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 400);
        }


        $createUSer = [
            'name' => $fields['first_name'] . ' ' . $fields['last_name'],
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'role' => $fields['role'],
            'contact_no' => $fields['contact_no'],
            'password' => Hash::make($request['password']),
            'state_id' => User::STATE_INACTIVE,
            'referral_code' => Str::random(8),
            'activation_key' => Str::random(16) . '_' . time()
        ];

        DB::beginTransaction();
        if (!$user = User::create($createUSer)) {
            return response([
                'message' => 'unexpected error occurred'
            ], 404);
        }
        if ($request->referral_code) {
            $userModel = User::where('referral_code', $request->referral_code)->first();
            if (empty($userModel)) {
                DB::rollBack();
                return response([
                    'message' => 'Referral code is invalid.'
                ], 404);
            } else {
                //get referral points from settings table
                $setting = Setting::where('key', 'points')->first();
                $reward = new Referral;
                $reward->referral_code = $userModel->referral_code;
                $reward->user_id = $userModel->id;
                $reward->created_by_id = $user->id;
                $reward->points = $setting->value;
                if (!$reward->save()) {
                    DB::rollBack();
                    return response([
                        'message' => $reward->getErrors()->all()
                    ], 404);
                }
                $rewards =  $userModel->referral_reward += $setting->value;
                $userModel->update(['referral_reward' => $rewards]);
            }
        }
        DB::commit();
        // app('mailhelper')->sendRegistrationMailToAdmin($user , true);
        //app('mailhelper')->sendRegistrationMailToUser($user , true);
        return response([
            'message' => 'User Registered Successfully',
            'details' => $user
        ], 200);


        return response([
            'message' => 'Some Thing Went Wrong'
        ], 404);
    }

    /**
     *
     * @OA\Post(
     * path="/user/login",
     * operationId="userLogin",
     *
     * tags={"User"},
     * summary="user login",
     * description="user login",
     * security={{ "basicAuth": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"email","password","device_token","device_name","device_type"},
     *              @OA\Property(property="email", type="email", format="email", example="sagar@toxsl.in"),
     *              @OA\Property(property="password", type="string", format="password", example="admin@123"),
     *              @OA\Property(property="device_token", type="string", format="string", example="DVtoken"),
     *              @OA\Property(property="device_name", type="string", format="string", example="DVname"),
     *              @OA\Property(property="device_type", type="integer", format="string", example="1")
     *           ),
     *       ),
     *   ),
     *
     * @OA\Response(
     *    response=422,
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
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="login successfully"),
     *          @OA\Property(property="user", type="string", example="User details"),
     *      )
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'email' => 'required',
            'password' => 'required|string',
            'device_token' => 'required|string',
            'device_name' => 'required|string',
            'device_type' => 'required|integer',
        ]);

        if ($validator->fails()) {

            return response([
                'message' => $validator->errors()
            ], 422);
        }
        $user = User::findByUsername($fields['email'])->first();
        if (!empty($user)) {
            if ($user->state_id == User::STATE_INACTIVE || $user->email_verified == User::STATE_INACTIVE) {
                return response([
                    'message' => 'Your account is not activated.'
                ], 400);
            }
        } else {
            return response([
                'message' => 'No account found.'
            ], 400);
        }
        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Password or Email is Incorrect!'
            ], 400);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        if ($user) {
            // Device Details Add on Login
            $deviceDetails = [
                'device_token' => $fields['device_token'],
                'device_name' => $fields['device_name'],
                'device_type' => $fields['device_type'],
                'access_token' => $token,
                'type_id' => $fields['device_type'],
                'created_by_id' => $user->id
            ];

            $device = DeviceDetail::create($deviceDetails);
            return response([
                'message' => 'Logged In Successfully',
                'details' => $user,
                'token' => $token
            ], 200);
        }
    }

    public function profileUpdate(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'gender' => 'required',
            'date_of_birth' => 'required|date|before:today',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 400);
        }

        $checkPhone = User::where('contact_no', $request->contact_no)->where('id', '!=', Auth::user()->id)->first();
        if ($checkPhone) {
            return response()->json([
                'message' => 'The phone number has already been taken',
            ], 400);
        }

        $user->gender = $request->gender;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->date_of_birth = $request->date_of_birth;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country_code = $request->country_code;
        $user->contact_no = $request->contact_no;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;

        if ($request->hasFile('image')) {
            $imageName = date('Ymd') . '_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->profile_picture->move(public_path('uploads/'), $imageName);
            $user->image = $imageName;
        }

        if ($user->save()) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->is_complete = 1;
            $user->save();

            return response()->json([
                "message" => "Profile updated successfully",
                'details' => $user
            ], 200);
        }

        return response([
            'message' => 'User does not exists!'
        ], 404);
    }

    /**
     *
     * @OA\Post(
     * path="/user/rating-and-review",
     * operationId="rating and review",
     * tags={"User"},
     * summary="rating and review",
     * description="rating and review",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"rating", "driver_id"},
     *              @OA\Property(property="rating", type="integer", example="3"),
     *              @OA\Property(property="driver_id", type="integer", example="5"),
     *              @OA\Property(property="review", type="string", example="good"),
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

    public function ratingAndReview(Request $request)
    {
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'driver_id' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 400);
        }

        $rating = new Rating;
        $rating->model_id = $request->driver_id;
        $rating->model_type = User::class;
        $rating->title = $request->review;
        $rating->rating = $request->rating;
        $rating->state_id = Rating::STATE_ACTIVE;
        $rating->created_by_id = 1;

        if ($rating->save()) {
            return response()->json([
                "message" => "Rating successfully added!",
                'details' => $rating
            ], 200);
        }
    }

    /**
     *
     * @OA\Get(
     * path="/user/rating-list",
     * operationId="rating list",
     * tags={"User"},
     * summary="rating list",
     * description="rating list",
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

    public function ratingList(Request $request)
    {

        $rating = Rating::get();

        if (count($rating) > 0) {
            return response()->json([
                "message" => "Rating list",
                'details' => $rating
            ], 200);
        } else {
            return response([
                'message' => 'Data not found!'
            ], 400);
        }
    }

    public function emergencyContacts()
    {
        try {
            $contacts = auth()->user()->emergencyContacts;
            if ($contacts) {
                return response()->json([
                    "message" => "Contact List Found successfully",
                    'details' => $contacts
                ], 200);
            } else {
                return response()->json([
                    "message" => "There are no emergency contacts.",
                ], 200);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     *
     * @OA\Post(
     * path="/user/add-emergency-contact",
     * operationId="add-emergency-contact",
     * tags={"User"},
     * summary="emergency contact",
     * description="emergency contact",
     * security={{ "sanctum": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"name","contact_no"},
     *              @OA\Property(property="name", type="string", format="name", example="test"),
     *              @OA\Property(property="contact_no", type="string", format="contact_no", example="test"),
     *           ),
     *       ),
     *   ),
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
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Contact added successfully"),
     *          @OA\Property(property="user", type="string", example="Contact Details"),
     *      )
     *     ),
     * )
     */
    public function addEmergencyContact(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'contact_no' => 'required',
            ]);
            if ($request->fails()) {
                return response()->json([
                    "message" => "Validation failed",
                    'errors' => $request->errors()
                ], 422);
            }
            $model = new EmergencyContact;
            $model->name = $validatedData['name'];
            $model->contact_no = $validatedData['contact_no'];
            if (!$model->save()) {
                return response()->json([
                    'message' => $model->getErrors()->all()
                ], 422);
            }
            return response()->json([
                "message" => "Emergency contact added successfully",
                'details' => $model
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function updateEmergencyContact(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'phone_number' => 'required',
            ]);
            if ($request->fails()) {
                return response()->json([
                    "message" => "Validation failed",
                    'errors' => $request->errors()
                ], 422);
            }
            $model = EmergencyContact::find($id);
            $model->name = $validatedData['name'];
            $model->contact_no = $validatedData['contact_no'];
            if (!$model->update()) {
                return response()->json([
                    'message' => $model->getErrors()->all()
                ], 422);
            }
            return response()->json([
                "message" => "Emergency contact updated successfully",
                'details' => $model
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    public function deleteEmergencyContact($id)
    {
        try {
            $model = EmergencyContact::find($id);
            if (!$model->delete()) {
                return response()->json([
                    'message' => $model->getErrors()->all()
                ], 200);
            }
            return response()->json([
                "message" => "Emergency contact deleted successfully.",
            ], 200);
        } catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    }

    /**
     *
     * @OA\Post(
     * path="/user/page-detail",
     * operationId="pages",
     * tags={"User"},
     * summary="pages",
     * description="pages",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"type_id"},
     *              @OA\Property(property="type_id", type="integer", example="1"),
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

    public function pageDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        $page = Page::find($request->type_id);

        if (!empty($booking)) {
            return response()->json([
                'message' => 'page detail',
                'details' => $page
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
     * path="/user/update-driver-location",
     * operationId="update location",
     * tags={"User"},
     * summary="update location",
     * description="update location",
     * security={{ "sanctum": {} }},
     *   @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"latitude", "longitude"},
     *              @OA\Property(property="current_location", type="string", example="USA"),
     *              @OA\Property(property="latitude", type="string", example="abc"),
     *              @OA\Property(property="longitude", type="string", example="abc"),
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

    public function updateDriverLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        $location = new UserDetail;
        $location->current_location = $request->current_location;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->state_id = User::STATE_ACTIVE;
        $location->created_by_id = Auth::user()->id;

        if ($location->save()) {
            return response()->json([
                'message' => 'Location update successfully!',
                'details' => $location
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
     * path="/user/profile-detail",
     * operationId="profile detail",
     * tags={"User"},
     * summary="profile detail",
     * description="profile detail",
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

    public function profileDetail(Request $request)
    {
        $detail = User::where('id', Auth::user()->id)->first();

        if (count($detail) > 0) {
            return response()->json([
                "message" => "Profile detail",
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
     * path="/user/ride-status",
     * operationId="ride-status",
     * tags={"User"},
     * summary="ride-status",
     * description="ride-status",
     * security={{ "sanctum": {} }},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"user_id"},
     *              @OA\Property(property="user_id", type="integer", example="5"),
     *              @OA\Property(property="status", type="integer", example="2"),
     *           ),
     *       ),
     *   ),
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

    public function rideStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        if (isset($request->status) && isset($request->user_id)) {
            $booking_detail = Booking::where('state_id', $request->status)->where('driver_id', $request->user_id)->get();

            return response()->json([
                "message" => "Booking detail",
                'details' => $booking_detail
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
     * path="/user/wallet-detail",
     * operationId="wallet detail",
     * tags={"User"},
     * summary="wallet detail",
     * description="wallet detail",
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

    public function walletDetail(Request $request)
    {
        $detail = User::where('id', Auth::user()->id)->first();

        $wallet_amount = getUserWalletAmount($detail->id);
        if (count($wallet_amount) > 0) {
            return response()->json([
                "message" => "Wallet detail",
                'details' => $wallet_amount
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
     * path="/user/wallet-top-up",
     * operationId="wallet top up",
     * tags={"User"},
     * summary="wallet top up",
     * description="wallet top up",
     * security={{ "sanctum": {} }},
     * @OA\Parameter(
     *          name="amount",
     *          description="Amount to be added to the wallet",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="number",
     *          )
     *      ),
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

    public function walletTopUp(Request $request)
    {
        $detail = Auth::user();
        if(!$detail){
            return redirect()->back()->with('msg', 'You are not authorised');
        }
        $wallet_amount = getUserWalletAmount($detail->id);

        $amount = (float) $request->input('amount');

        if ($amount <= 0) {
            return response()->json([
                'message' => 'Amount must be greater than 0'
            ], 400);
        }

        if (count($wallet_amount) > 0) {
            $wallet = $detail->walletDetail;
            $wallet->balance += $amount;
            $wallet->save();
        } else {
            $wallet = new WalletDetail();
            $wallet->user_id = $detail->id;
            $wallet->balance = $amount;
            $wallet->save();
        }

        return response()->json([
            "message" => "Wallet balance updated",
            "balance" => $wallet->balance
        ], 200);
    }


    /**
     * @OA\Post(
     * path="/user/pay-ride",
     * operationId="payRide",
     * tags={"User"},
     * summary="Pay for a ride",
     * description="Pay for a ride using wallet balance",
     * security={{ "sanctum": {} }},
     * @OA\Parameter(
     *          name="ride_id",
     *          description="ID of the ride to be paid for",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     * @OA\Response(
     *    response=400,
     *    description="Validator Error"
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Authentication Error",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Something went wrong"),
     *      )
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Not Found",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Ride not found"),
     *      )
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Unprocessable Entity",
     *    @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Wallet balance is insufficient to pay for this ride"),
     *      )
     * ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     * ),
     * )
     */

     public function payRide(Request $request)
     {
         $detail = Auth::user();
         if(!$detail){
             return redirect()->back()->with('msg', 'You are not authorised');
         }
         $ride_id = $request->input('ride_id');
         $ride = Ride::find($ride_id);
     
         if (!$ride) {
             return response()->json([
                 'message' => 'Ride not found'
             ], 404);
         }
     
         $ride_amount = (float) $ride->amount;
     
         $wallet_amount = getUserWalletAmount($detail->id);
     
         if (count($wallet_amount) > 0) {
             $wallet = $detail->walletDetail;
             $wallet_balance = (float) $wallet->balance;
     
             if ($wallet_balance >= $ride_amount) {
     
                 // Begin a database transaction
                 DB::beginTransaction();
     
                 try {
                     $wallet->balance -= $ride_amount;
                     $wallet->save();
                     $transaction = new Transaction();
                     $transaction->user_id = $detail->id;
                     $transaction->ride_id = $ride_id;
                     $transaction->amount = $ride_amount;
                     $transaction->type = 'debit';
                     $transaction->save();

                     DB::commit();
     
                     return response()->json([
                         "message" => "Ride payment successful",
                         "balance" => $wallet->balance
                     ], 200);
                 } catch (\Exception $e) {
                     DB::rollback();
                     return response()->json([
                         'message' => 'Failed to pay for the ride'
                     ], 500);
                 }
     
             } else {
                 return response()->json([
                     'message' => 'Wallet balance is insufficient to pay for this ride'
                 ], 422);
             }
         } else {
             return response()->json([
                 'message' => 'Wallet balance is insufficient to pay for this ride'
             ], 422);
         }
     }
     

    /**
     *
     * @OA\Get(
     * path="/user/logout",
     * operationId="logout",
     * tags={"User"},
     * summary="logout",
     * description="logout",
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

    public function logout(Request $request)
    {

        $user_id = Auth::user()->id;
        $device_token = $request->bearerToken();

        // delete on 'user_device_tokens'
        DeviceDetail::where('created_by_id', $user_id)->where('device_token', $device_token)->delete();

        return response(['message' => 'You have been successfully logged out!'], 200);
    }

    /**
     *
     * @OA\Post(
     * path="/user/change-password",
     * summary=" driver-time-estimation",
     * description="user change password",
     * operationId="userChangePassword",
     * tags={"User"},
     * security={{ "sanctum": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"old-password","password","password_confirmation"},
     *              @OA\Property(property="old-password", type="string", format="password", example="secret123"),
     *              @OA\Property(property="password", type="string", format="password", example="secret1234"),
     *              @OA\Property(property="password_confirmation", type="string", format="password", example="secret1234"),
     *           ),
     *       ),
     *   ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="Password  Updated successfully!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */

    public function changePassword(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $fields = $request->all();
        $validator = Validator::make($fields, [
            'old-password' => [
                'required',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Old password does not match.');
                    }
                }
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 400);
        }

        if ($request['old-password']  == $request['password']) {
            return response()->json([
                "message" => "Old Password and New Password cannot be same",
            ], 400);
        }

        $user->password = Hash::make($request['password']);
        if ($user->save()) {
            return response()->json([
                "message" => "Password changed successfully",
                'user' => $user
            ], 200);
        }
    }

    /**
     * @OA\Get(
     *      path="/user/check",
     *      operationId="userCheck",
     *      tags={"User"},
     *      security={{ "sanctum": {} }},
     *      summary="",
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="User Data!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="data Not Found!"),
     *        )
     * ),
     * )
     */


    public function userCheck(Request $request)
    {
        $DeviceDetail = DeviceDetail::where('access_token', $request->bearerToken())->first();

        if ($DeviceDetail && $request->bearerToken()) {
            $user = User::find($DeviceDetail->created_by_id);

            if ($user) {
                return response(['details' => $user], 200);
            } else {
                return response()->json([
                    'message' => 'User Not Found'
                ], 404);
            }
        } else {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 403);
        }
    }

    /**
     *
     * @OA\Post(
     * path="/user/driver-time-estimation",
     * summary="driver time estimation",
     * description="driver time estimation",
     * operationId="driver time estimation",
     * tags={"User"},
     * security={{ "sanctum": {} }},
     *      @OA\RequestBody(
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              @OA\Property(property="id", type="integer", example="2"),
     *              @OA\Property(property="time", type="string", example=""),
     *           ),
     *       ),
     *   ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *    @OA\Property(property="status", type="integer", example="Password  Updated successfully!"),
     *        )
     * ),
     * @OA\Response(
     *    response=401,
     *    description="Not Found",
     *    @OA\JsonContent(
     *    @OA\Property(property="message", type="string", example="Something went wrong"),
     *        )
     * ),
     *     )
     * )
     */

    public function driverTimeEstimation(Request $request)
    {
        $data = [];
        if (!empty($request->id)) {
            $booking = Booking::find($request->id);
            if (!empty($booking)) {
                $title = " Your Ride Request " . "has been accepted by a Captain";
                if ($request->time) {
                    $title = " Your Ride Request " . "has been accepted by a Captain";
                }
                Notification::create([
                    'model' => $booking,
                    'to_user_id' => $booking->created_by_id,
                    'type_id' => 1,
                    'title' => $title,
                    'created_by_id' => Auth::user()->id
                ], false, true);
                $data['message'] = "Tip added successfully";
                $data['detail'] = $booking->asJson();
            } else {
                $data['message'] = "Booking not found";
            }
        } else {
            $data['message'] = "Please enter valid data";
        }

        return response(['data' => $data], 200);
    }

    /**
     *
     * @OA\Get(
     * path="/user/nearest-driver",
     * operationId="nearest driver",
     * tags={"User"},
     * summary="nearest driver",
     * description="nearest driver",
     * security={{ "sanctum": {} }},
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *              required={"latitude"},
     *              @OA\Property(property="latitude", type="integer", example="5010"),
     *              @OA\Property(property="longitude", type="integer", example="2458"),
     *              @OA\Property(property="radius", type="integer", example="150"),
     *           ),
     *       ),
     *   ),
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

    public function nearestDriver(Request $request)
    {
        $fields = $request->all();

        $validator = Validator::make($fields, [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()
            ], 422);
        }

        $detail = findNearestDrivers($request->latitude, $request->longitude, $request->radius);

        if ($detail) {
            return response(['details' => $detail], 200);
        } else {
            return response()->json([
                'message' => 'Data Not Found!'
            ], 404);
        }
    }
}
