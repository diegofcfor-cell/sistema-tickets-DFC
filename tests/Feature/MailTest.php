<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestBrevoMail;

class MailTest extends TestCase
{
    // 1. Verifica que la vista del formulario cargue correctamente (HTTP 200)
    public function test_la_vista_del_formulario_carga_correctamente()
    {
        $response = $this->get('/mail');
        $response->assertStatus(200);
        $response->assertViewIs('formulario');
    }

    // 2. Verifica la validación de campos obligatorios vacíos
    public function test_los_campos_obligatorios_son_requeridos()
    {
        $response = $this->post('/mail/enviar', []);
        $response->assertSessionHasErrors(['nombre', 'email', 'mensaje']);
    }

    // 3. Verifica que se utilice Mail::fake() para simular envíos
    public function test_se_simula_el_envio_de_mail()
    {
        Mail::fake();

        $this->post('/mail/enviar', [
            'nombre'  => 'Juan Perez',
            'email'   => 'juan@example.com',
            'mensaje' => 'Mensaje de prueba',
        ]);

        Mail::assertSent(TestBrevoMail::class);
    }

    // 4. Verifica que el mail se envíe al destinatario correcto
    public function test_el_mail_se_envia_al_destinatario_correcto()
    {
        Mail::fake();

        $this->post('/mail/enviar', [
            'nombre'  => 'Juan Perez',
            'email'   => 'juan@example.com',
            'mensaje' => 'Mensaje de prueba',
        ]);

        Mail::assertSent(TestBrevoMail::class, function ($mail) {
            return $mail->hasTo('soporte@sistematickets.com');
        });
    }

    // 5. Verifica que los datos recibidos coincidan con los enviados
    public function test_los_datos_del_mail_son_correctos()
    {
        Mail::fake();

        $datosFormulario = [
            'nombre'  => 'Juan Perez',
            'email'   => 'juan@example.com',
            'mensaje' => 'Mensaje de prueba',
        ];

        $this->post('/mail/enviar', $datosFormulario);

        Mail::assertSent(TestBrevoMail::class, function ($mail) use ($datosFormulario) {
            return $mail->datos['nombre'] === $datosFormulario['nombre'] &&
                   $mail->datos['email'] === $datosFormulario['email'] &&
                   $mail->datos['mensaje'] === $datosFormulario['mensaje'];
        });
    }

    // 6. Verifica que NO se envíe mail si falla la validación
    public function test_no_se_envia_mail_si_falla_la_validacion()
    {
        Mail::fake();

        $this->post('/mail/enviar', [
            'nombre' => 'Juan Perez', // Faltan email y mensaje
        ]);

        Mail::assertNothingSent();
    }

    // 7. Actividad Teléfono: Test para teléfono de menos de 8 caracteres (Inválido)
    public function test_telefono_no_puede_tener_menos_de_8_caracteres()
    {
        $response = $this->post('/mail/enviar', [
            'nombre'   => 'Juan Perez',
            'email'    => 'juan@example.com',
            'mensaje'  => 'Mensaje de prueba',
            'telefono' => '1234567', // 7 dígitos -> Debe fallar
        ]);

        $response->assertSessionHasErrors(['telefono']);
    }

    // 8. Actividad Teléfono: Test para teléfono con 8 o más caracteres (Válido)
    public function test_envio_de_mail_con_telefono_valido()
    {
        Mail::fake();

        $response = $this->post('/mail/enviar', [
            'nombre'   => 'Juan Perez',
            'email'    => 'juan@example.com',
            'mensaje'  => 'Mensaje de prueba',
            'telefono' => '3704123456', // 10 dígitos -> Válido
        ]);

        $response->assertSessionHasNoErrors();
        Mail::assertSent(TestBrevoMail::class);
    }
}
