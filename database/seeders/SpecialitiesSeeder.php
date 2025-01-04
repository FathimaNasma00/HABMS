<?php

namespace Database\Seeders;

use App\Models\specialty;
use Illuminate\Database\Seeder;

class SpecialitiesSeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cardiologist',
                'description' => 'Focuses on diagnosing and treating diseases of the heart and blood vessels, such as heart attacks, arrhythmias, and hypertension.',
            ],
            [
                'name' => 'Dermatologist',
                'description' => 'Specializes in conditions of the skin, hair, and nails, including acne, eczema, psoriasis, and skin cancer.',
            ],
            [
                'name' => 'Neurologist',
                'description' => 'Treats disorders of the nervous system, including the brain, spinal cord, and nerves, such as epilepsy, migraines, and Parkinson’s disease.',
            ],
            [
                'name' => 'Pediatrician',
                'description' => 'Provides medical care for infants, children, and adolescents, addressing growth, development, and common childhood illnesses.',
            ],
            [
                'name' => 'Oncologist',
                'description' => 'Focuses on diagnosing and treating cancer, guiding patients through treatments like chemotherapy, radiation, and immunotherapy.',
            ],
            [
                'name' => 'Orthopedic Surgeon',
                'description' => 'Treats musculoskeletal issues, including broken bones, joint disorders, and spinal problems, often performing surgeries.',
            ],
            [
                'name' => 'Psychiatrist',
                'description' => 'Specializes in mental health, diagnosing and treating conditions such as depression, anxiety, bipolar disorder, and schizophrenia.',
            ],
            [
                'name' => 'Ophthalmologist',
                'description' => 'Provides care for eye health, treating vision problems, eye diseases like glaucoma, and performing eye surgeries such as cataract removal.',
            ],
            [
                'name' => 'Gynecologist',
                'description' => 'Focuses on the female reproductive system, addressing issues such as menstrual disorders, pregnancy, and menopause.',
            ],
            [
                'name' => 'Endocrinologist',
                'description' => 'Treats hormonal imbalances and related conditions, including diabetes, thyroid disorders, and adrenal gland issues.',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrInsert(
                ['name' => $specialty['name']], // Match condition
                ['description' => $specialty['description']] // Values to update or insert
            );
        }

    }
}
