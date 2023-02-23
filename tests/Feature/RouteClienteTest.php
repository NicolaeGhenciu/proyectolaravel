<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use App\Models\Empleado;

class RouteClienteTest extends TestCase
{
    public function test_formRegCliente()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formRegCliente'
        $response = $this->get(route('formRegCliente'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formRegCliente' fue cargada
        $response->assertViewIs('formRegCliente');
    }

    public function test_listaClientes()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/listaClientes'
        $response = $this->get(route('listaClientes'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaClientes' fue cargada
        $response->assertViewIs('listaClientes');
    }

    public function test_mensajeBorrarCliente()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/mensajeBorrarCliente'
        $response = $this->get(route('mensajeBorrarCliente', ['cliente' => 30]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'mensajeBorrarCliente' fue cargada
        $response->assertViewIs('mensajeBorrarCliente');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('cliente');
    }
}
