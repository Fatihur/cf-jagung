<?php

namespace App\Filament\Resources\DiseaseSymptomRuleResource\Pages;

use App\Filament\Resources\DiseaseSymptomRuleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiseaseSymptomRule extends EditRecord
{
    protected static string $resource = DiseaseSymptomRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
