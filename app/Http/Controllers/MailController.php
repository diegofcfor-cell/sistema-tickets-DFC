<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestBrevoMail;

class MailController extends Controller
{
    public function mostrarFormulario()
    {
        return view('formulario');
    }

    public function enviar(Request $request)
    {
        $validated = $request->validate([
            'nombre'   => 'required|string',
            'email'    => 'required|email',
            'mensaje'  => 'required|string',
            'telefono' => 'nullable|string|min:8', // Validación del teléfono (mínimo 8 caracteres)
        ]);

        Mail::to('soporte@sistematickets.com')->send(new TestBrevoMail($validated));

        return back()->with('exito', 'Correo enviado correctamente');
    }
}
