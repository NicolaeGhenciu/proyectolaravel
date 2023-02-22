<?php

namespace Tests\Feature;

use App\Models\Empleado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmpleadosTest extends TestCase
{
    use RefreshDatabase;

    public function test_listar_empleados()
    {
        // Crear algunos empleados para la prueba
        Empleado::factory()->count(20)->create();

        // Realizar la solicitud GET a la ruta "listaEmpleados"
        $response = $this->get(route('listaEmpleados'));

        // Verificar que se recibe una respuesta HTTP 200 (éxito)
        $response->assertStatus(200);

        // Verificar que se muestra la vista "listaEmpleados"
        $response->assertViewIs('listaEmpleados');

        // Verificar que se reciben los datos correctos de los empleados
        $response->assertViewHas('empleados', function ($empleados) {
            return $empleados->count() === 10;
        });
    }
}
