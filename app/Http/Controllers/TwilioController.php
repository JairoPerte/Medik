<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwilioService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TwilioController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }

    public function sendSmsToUser(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user || !$user->numtel) {
                return redirect()->back()->with('error', 'Usuario no encontrado o sin número de teléfono.');
            }

            // Obtener el mensaje desde el formulario
            $message = $request->input('message');

            // Enviar el SMS con Twilio
            $this->twilioService->sendSms($user->numtel, $message);

            return redirect()->back()->with('success', 'Se te acaba de enviar un SMS con los datos de la consulta.');
        } else {
            return redirect()->back()->with('error', 'No estás autenticado.');
        }
    }
}
