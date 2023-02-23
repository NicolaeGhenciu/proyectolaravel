<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Cliente;
use App\Models\Empleado;

class RouteCuotasTest extends TestCase
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
    }

    public function test_formularioCuota()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formularioCuota'
        $response = $this->get(route('formularioCuota'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formularioCuota' fue cargada
        $response->assertViewIs('formCuotaExcepcional');
    }

    public function test_listaCuotas()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/mensajeBorrarCliente'
        $response = $this->get(route('listaCuotas', ['filtro' => 'SI']));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'mensajeBorrarCliente' fue cargada
        $response->assertViewIs('listaCuotas');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('cuotas');
    }

    public function test_forModCuota()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/forModCuota'
        $response = $this->get(route('forModCuota', ['cuota' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'forModCuota' fue cargada
        $response->assertViewIs('forModCuota');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('cuota');
    }

    public function test_mensajeBorrarCuota()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/mensajeBorrarCuota'
        $response = $this->get(route('mensajeBorrarCuota', ['cuota' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'mensajeBorrarCuota' fue cargada
        $response->assertViewIs('mensajeBorrarCuota');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('cuota');
    }
}
