<?php

namespace App\Filament\Resources\DiseaseSymptomRuleResource\Pages;

use App\Filament\Resources\DiseaseSymptomRuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiseaseSymptomRules extends ListRecords
{
    protected static string $resource = DiseaseSymptomRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
