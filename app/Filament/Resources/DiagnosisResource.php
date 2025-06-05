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
    protected static ?string $navigationGroup = 'Sistem Pakar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Diagnosis')
                    ->description('Detail hasil diagnosis yang telah dilakukan')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('user.name')
                                    ->label('Nama User')
                                    ->disabled()
                                    ->default('Guest'),

                                Forms\Components\TextInput::make('user_session')
                                    ->label('Session ID')
                                    ->disabled()
                                    ->prefixIcon('heroicon-m-identification'),
                            ]),

                        Forms\Components\TextInput::make('user_ip')
                            ->label('IP Address')
                            ->disabled()
                            ->prefixIcon('heroicon-m-globe-alt'),

                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Tanggal Diagnosis')
                            ->disabled()
                            ->prefixIcon('heroicon-m-calendar'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Gejala yang Dipilih')
                    ->description('Daftar gejala yang dipilih oleh user')
                    ->schema([
                        Forms\Components\Textarea::make('selected_symptoms')
                            ->label('Gejala Terpilih')
                            ->disabled()
                            ->rows(4)
                            ->formatStateUsing(function ($state) {
                                if (is_array($state)) {
                                    $symptoms = \App\Models\Symptom::whereIn('id', $state)->pluck('name')->toArray();
                                    return implode("\n• ", [''] + $symptoms);
                                }
                                return $state;
                            }),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Hasil Diagnosis')
                    ->description('Hasil perhitungan Certainty Factor')
                    ->schema([
                        Forms\Components\Textarea::make('results')
                            ->label('Hasil Diagnosis')
                            ->disabled()
                            ->rows(6)
                            ->formatStateUsing(function ($state) {
                                if (is_array($state)) {
                                    $formatted = [];
                                    foreach ($state as $index => $result) {
                                        if (isset($result['disease']['name']) && isset($result['percentage']) && isset($result['cf_value'])) {
                                            $rank = $index + 1;
                                            $formatted[] = "{$rank}. {$result['disease']['name']} - {$result['percentage']}% (CF: {$result['cf_value']})";
                                        }
                                    }
                                    return implode("\n", $formatted);
                                }
                                return $state;
                            }),
                    ])
                    ->collapsible(),
            ])
            ->columns(1);
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
                        if (is_array($state) && !empty($state) && isset($state[0])) {
                            $top = $state[0];
                            if (isset($top['disease']['name']) && isset($top['percentage'])) {
                                return $top['disease']['name'] . ' (' . $top['percentage'] . '%)';
                            }
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
                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->url(fn (Diagnosis $record): string => route('diagnosis.export.pdf', $record->id))
                    ->openUrlInNewTab(),
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
