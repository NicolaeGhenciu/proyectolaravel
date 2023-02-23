<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empleado;

class RouteOtrosTest extends TestCase
{

    //Menu principal, noticias

    public function test_siempreColgados()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/siemprecolgados'
        $response = $this->get(route('siemprecolgados'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'siemprecolgados' fue cargada
        $response->assertViewIs('siemprecolgados');
    }

    public function test_login()
    {
        // Simulamos una petición GET a la ruta '/siemprecolgados'
        $response = $this->get(route('login'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('login');
    }

    public function test_formRecuperarPass()
    {
        // Simulamos una petición GET a la ruta '/siemprecolgados'
        $response = $this->get(route('formRecuperarPass'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('formRecuperarPass');
    }

    public function test_formTareaParaClientes()
    {
        // Simulamos una petición GET a la ruta '/siemprecolgados'
        $response = $this->get(route('formTareaParaClientes'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'login' fue cargada
        $response->assertViewIs('formTareaParaCliente');
    }
}
