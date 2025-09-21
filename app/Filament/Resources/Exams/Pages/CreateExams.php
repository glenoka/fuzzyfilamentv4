<?php

namespace App\Filament\Resources\Exams\Pages;

use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Exams\ExamsResource;

class CreateExams extends CreateRecord
{
    protected static string $resource = ExamsResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        // 1. Ambil semua ID participant yang dipilih dari form
        $participantIds = $data['participant_ids'];

        // 2. Hapus 'participant_ids' dari data utama karena tidak ada di tabel
        unset($data['participant_ids']);
        
        $createdRecord = null;

        // 3. Looping untuk setiap ID participant
        foreach ($participantIds as $participantId) {
            
            // 4. Gabungkan data umum dengan participant_id saat ini
            $recordData = array_merge($data, [
                'participant_id' => $participantId,
            ]);

            // 5. Buat record baru di database
            $createdRecord = static::getModel()::create($recordData);
        }

        // 6. Kembalikan record terakhir yang dibuat
        // Filament akan menggunakannya untuk notifikasi dan redirect
        return $createdRecord;
    }
}
