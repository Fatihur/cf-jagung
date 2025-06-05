<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiagnosisResource\Pages;
use App\Filament\Resources\DiagnosisResource\RelationManagers;
use App\Models\Diagnosis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiagnosisResource extends Resource
{
    protected static ?string $model = Diagnosis::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Riwayat Diagnosis';
    protected static ?string $modelLabel = 'Diagnosis';
    protected static ?string $pluralModelLabel = 'Riwayat Diagnosis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_session')
                    ->label('Session ID')
                    ->disabled(),

                Forms\Components\Textarea::make('selected_symptoms')
                    ->label('Gejala Terpilih')
                    ->disabled()
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            $symptoms = \App\Models\Symptom::whereIn('id', $state)->pluck('name')->toArray();
                            return implode(', ', $symptoms);
                        }
                        return $state;
                    }),

                Forms\Components\Textarea::make('results')
                    ->label('Hasil Diagnosis')
                    ->disabled()
                    ->formatStateUsing(function ($state) {
                        if (is_array($state)) {
                            $formatted = [];
                            foreach ($state as $result) {
                                $formatted[] = $result['disease']['name'] . ' (' . $result['percentage'] . '%)';
                            }
                            return implode("\n", $formatted);
                        }
                        return $state;
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->default('Guest')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_session')
                    ->label('Session')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('selected_symptoms')
                    ->label('Jumlah Gejala')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0),

                Tables\Columns\TextColumn::make('results')
                    ->label('Hasil Teratas')
                    ->formatStateUsing(function ($state) {
                        if (is_array($state) && !empty($state)) {
                            $top = $state[0];
                            return $top['disease']['name'] . ' (' . $top['percentage'] . '%)';
                        }
                        return '-';
                    }),

                Tables\Columns\TextColumn::make('user_ip')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiagnoses::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }
}
