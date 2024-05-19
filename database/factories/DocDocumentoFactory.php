<?php

namespace Database\Factories;

use App\Models\Doc_documento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doc_documento>
 */
class DocDocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Doc_documento::class;

    // Creacion de registro de documentos
    public function definition(): array
    {
        return [
            'DOC_NOMBRE' => $this->faker->word,
            'DOC_CODIGO' => 'INS-ING-' . $this->faker->unique()->numberBetween(1, 100),
            'DOC_CONTENIDO' => $this->faker->text,
            'DOC_ID_TIPO' => 1,
            'DOC_ID_PROCESO' => 1,
        ];
    }
}
