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
    protected static ?string $navigationGroup = 'Sistem Pakar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Rule')
                    ->description('Informasi dasar tentang aturan Certainty Factor')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Kode Rule')
                            ->maxLength(15)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Otomatis: R01, R02, ...')
                            ->helperText('Kode akan dibuat otomatis jika dikosongkan')
                            ->disabled(fn ($record) => $record !== null)
                            ->prefixIcon('heroicon-m-hashtag')
                            ->columnSpan(1),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Hubungan Gejala-Penyakit')
                    ->description('Tentukan hubungan antara gejala dan penyakit')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('disease_id')
                                    ->label('Penyakit')
                                    ->relationship('disease', 'name', fn ($query) => $query->orderBy('code'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->optionsLimit(50)
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->code} - {$record->name}")
                                    ->prefixIcon('heroicon-m-bug-ant'),

                                Forms\Components\Select::make('symptom_id')
                                    ->label('Gejala')
                                    ->relationship('symptom', 'name', fn ($query) => $query->orderBy('code'))
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->optionsLimit(50)
                                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->code} - {$record->name}")
                                    ->prefixIcon('heroicon-m-clipboard-document-list'),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Certainty Factor')
                    ->description('Tentukan tingkat keyakinan pakar')
                    ->schema([
                        Forms\Components\Select::make('cf_value')
                            ->label('Tingkat Keyakinan Pakar')
                            ->required()
                            ->options([
                                '0.3' => 'Sedikit Yakin (30%) - CF: 0.3',
                                '0.4' => 'Kurang Yakin (40%) - CF: 0.4',
                                '0.6' => 'Agak Yakin (60%) - CF: 0.6',
                                '0.7' => 'Cukup Yakin (70%) - CF: 0.7',
                                '0.8' => 'Sangat Yakin (80%) - CF: 0.8',
                                '0.85' => 'Sangat Yakin (85%) - CF: 0.85',
                            ])
                            ->default('0.7')
                            ->helperText('Pilih tingkat keyakinan pakar terhadap hubungan gejala-penyakit ini')
                            ->prefixIcon('heroicon-m-scale'),

                        Forms\Components\Placeholder::make('cf_explanation')
                            ->label('Penjelasan Certainty Factor')
                            ->content('
                                • CF 0.3 (30%): Pakar sedikit yakin dengan hubungan ini
                                • CF 0.4 (40%): Pakar kurang yakin dengan hubungan ini
                                • CF 0.6 (60%): Pakar agak yakin dengan hubungan ini
                                • CF 0.7 (70%): Pakar cukup yakin dengan hubungan ini
                                • CF 0.8 (80%): Pakar sangat yakin dengan hubungan ini
                                • CF 0.85 (85%): Pakar sangat yakin dengan hubungan ini
                            ')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ])
            ->columns(1);
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
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => 'CF: ' . number_format((float)$state, 2)),

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
