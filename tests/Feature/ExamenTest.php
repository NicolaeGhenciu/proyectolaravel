<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use App\Models\Empleado;

class ExamenTest extends TestCase
{
    public function test_formRemesaMensual()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formRemesaMensual'
        $response = $this->get(route('formRemesaMensual'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formRemesaMensual' fue cargada
        $response->assertViewIs('formRemesaMensual');

        $response->assertSee('Formulario Mantenimiento');
    }
}
