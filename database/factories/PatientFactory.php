<?php

namespace Database\Factories;
use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apellido_paterno' => $this->faker->lastName,
            'apellido_materno' => $this->faker->lastName,
            'direccion' => $this->faker->streetAddress,
            'email' => $this->faker->email,
            'telefono_1' => $this->faker->phoneNumber,
            'ocupacion' => $this->faker->jobTitle,
            'fecha_nacimiento' => $this->faker->date($format = 'd/m/Y', $max = 'now'),
            'sexo' => $this->faker->randomElement(['Masculino', 'Femenino']),
            'nombre' => $this->faker->firstName(),
            'refer_id' => $this->faker->randomElement(['1', '9']),
            'ultima_visita' => $this->faker->realText($maxNbChars = 10, $indexSize = 2)
        ];
    }
}
