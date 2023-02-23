<?php

namespace Tests\Feature;

use App\Models\Empleado;
use Tests\TestCase;

class FormEmpleadoTest extends TestCase
{
    public function test_formulario_empleado()
    {
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        $response = $this->actingAs($user)
            ->post('empleado', [
                'nif' => '79930553X',
                'nombre_y_apellidos' => 'Emilio Delgado',
                'password' => '$2y$10$8P4I/tc1tDs2h2AqfUhHfeXfw.Wd657Sh9PovM6AgsLVFGic5qyI6',
                'fecha_alta' => '2023-01-31',
                'email' => 'emilio@hotmail.com',
                'telefono' => '644571921',
                'direccion' => 'Desengaño 21',
                'es_admin' => '1',
            ]);

        if ($response->status() == 302) {
            $response = $this->followRedirects($response);
        }

        $response = $this->get(route('formRegEmpleado'));

        $response->assertStatus(200);

        $response->assertViewIs('formRegEmpleado');
    }
}
