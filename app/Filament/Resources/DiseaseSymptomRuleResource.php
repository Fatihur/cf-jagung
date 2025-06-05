<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseSymptomRuleResource\Pages;
use App\Filament\Resources\DiseaseSymptomRuleResource\RelationManagers;
use App\Models\DiseaseSymptomRule;
use App\Enums\ConfidenceLevel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiseaseSymptomRuleResource extends Resource
{
    protected static ?string $model = DiseaseSymptomRule::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Aturan CF';
    protected static ?string $modelLabel = 'Aturan CF';
    protected static ?string $pluralModelLabel = 'Aturan CF';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode Rule')
                    ->maxLength(15)
                    ->unique(ignoreRecord: true)
                    ->placeholder('Otomatis: R001, R002, ...')
                    ->helperText('Kode akan dibuat otomatis jika dikosongkan')
                    ->disabled(fn ($record) => $record !== null), // Disable editing existing codes

                Forms\Components\Select::make('disease_id')
                    ->label('Penyakit')
                    ->relationship('disease', 'name')
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('symptom_id')
                    ->label('Gejala')
                    ->relationship('symptom', 'name')
                    ->required()
                    ->searchable(),

                Forms\Components\Select::make('cf_value')
                    ->label('Tingkat Keyakinan Pakar')
                    ->required()
                    ->options([
                        '0.2' => 'Tidak Yakin (20%)',
                        '0.4' => 'Kurang Yakin (40%)',
                        '0.6' => 'Cukup Yakin (60%)',
                        '0.8' => 'Yakin (80%)',
                        '1.0' => 'Sangat Yakin (100%)',
                    ])
                    ->default('0.8')
                    ->helperText('Pilih tingkat keyakinan pakar terhadap hubungan gejala-penyakit'),

                Forms\Components\TextInput::make('cf_value')
                    ->label('Nilai CF Manual (Opsional)')
                    ->numeric()
                    ->step(0.01)
                    ->minValue(0)
                    ->maxValue(1)
                    ->helperText('Kosongkan untuk menggunakan pilihan di atas, atau isi manual (0.00-1.00)')
                    ->hidden(fn ($get) => !empty($get('cf_value'))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('disease.name')
                    ->label('Penyakit')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('symptom.name')
                    ->label('Gejala')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cf_value')
                    ->label('Nilai CF')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 2)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListDiseaseSymptomRules::route('/'),
            'create' => Pages\CreateDiseaseSymptomRule::route('/create'),
            'edit' => Pages\EditDiseaseSymptomRule::route('/{record}/edit'),
        ];
    }
}
