<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserRegistrationService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    protected $userRegService;
   public function __construct(UserRegistrationService $userRegService){
    $this->userRegService = $userRegService;

   }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**Regis
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
       
            try {
                $userData = $request->all();
                
                // Llamar al servicio para registrar al usuario
                $user = $this->userRegService->registerUser($userData);
    
                return response()->json(['message' => 'Usuario registrado con éxito', 'user' => $user], 201);
            } catch (ValidationException $e) {
                return response()->json(['error' => $e->getMessage()], $e->getCode());
            }
        }
 
}
