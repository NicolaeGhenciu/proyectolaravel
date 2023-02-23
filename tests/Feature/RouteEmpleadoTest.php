<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empleado;

class RouteEmpleadoTest extends TestCase
{

    //Empleados

    public function test_formRegEmpleado()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formRegEmpleado'
        $response = $this->get(route('formRegEmpleado'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formRegEmpleado' fue cargada
        $response->assertViewIs('formRegEmpleado');
    }

    public function test_listaEmpleados()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/listaEmpleados'
        $response = $this->get(route('listaEmpleados'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaEmpleados' fue cargada
        $response->assertViewIs('listaEmpleados');
    }

    public function test_mensajeBorrarEmpleado()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/mensajeBorrarEmpleado'
        $response = $this->get(route('mensajeBorrarEmpleado', ['empleado' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'mensajeBorrarEmpleado' fue cargada
        $response->assertViewIs('mensajeBorrarEmpleado');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('empleado');
    }


    public function test_forModEmpleado()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/forModEmpleado'
        $response = $this->get(route('forModEmpleado', ['empleado' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'forModEmpleado' fue cargada
        $response->assertViewIs('forModEmpleado');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('empleado');
    }

    public function test_miCuenta()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/miCuenta'
        $response = $this->get(route('miCuenta', ['empleado' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'miCuenta' fue cargada
        $response->assertViewIs('miCuenta');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('empleado');
    }
}
