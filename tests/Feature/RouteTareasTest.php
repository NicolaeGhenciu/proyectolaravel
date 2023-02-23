<?php

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tarea;
use App\Models\Empleado;

class RouteTareasTest extends TestCase
{
    public function test_formTarea()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formTarea'
        $response = $this->get(route('formTarea'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formTarea' fue cargada
        $response->assertViewIs('formTarea');
    }

    public function test_listaTareas()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/listaTareas'
        $response = $this->get(route('listaTareas'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaTareas' fue cargada
        $response->assertViewIs('listaTareas');
    }

    public function test_detallesTarea()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/detallesTarea'
        $response = $this->get(route('detallesTarea', ['tarea' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'detallesTarea' fue cargada
        $response->assertViewIs('detallesTarea');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tarea');
    }

    public function test_mensajeBorrarTarea()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/mensajeBorrarTarea'
        $response = $this->get(route('mensajeBorrarTarea', ['tarea' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'mensajeBorrarTarea' fue cargada
        $response->assertViewIs('mensajeBorrarTarea');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tarea');
    }

    public function test_forModTarea()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'santi@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/forModTarea'
        $response = $this->get(route('forModTarea', ['tarea' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'forModTarea' fue cargada
        $response->assertViewIs('forModTarea');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tarea');
    }

    public function test_detallesTareaOperario()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'victor@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/detallesTareaOperario'
        $response = $this->get(route('detallesTareaOperario', ['tarea' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'detallesTareaOperario' fue cargada
        $response->assertViewIs('detallesTarea');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tarea');
    }

    public function test_formCompletarTarea()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'victor@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/formCompletarTarea'
        $response = $this->get(route('formCompletarTarea', ['tarea' => 1]));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'formCompletarTarea' fue cargada
        $response->assertViewIs('formCompletarTarea');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tarea');
    }

    public function test_listaTareasOperario()
    {

        //Autenticar al usuario
        $user = Empleado::where('email', 'victor@gmail.com')->first();
        $this->actingAs($user);

        // Simulamos una petición GET a la ruta '/listaTareasOperario'
        $response = $this->get(route('listaTareasOperario'));

        // Verificamos que la petición fue exitosa (código de respuesta HTTP 200)
        $response->assertStatus(200);

        // Verificamos que la vista 'listaTareasOperario' fue cargada
        $response->assertViewIs('listaTareas');

        // Verificamos que la vista contiene una variable llamada 'empleados'
        $response->assertViewHas('tareas');
    }
}
