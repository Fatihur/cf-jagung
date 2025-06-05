<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SymptomResource\Pages;
use App\Filament\Resources\SymptomResource\RelationManagers;
use App\Models\Symptom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SymptomResource extends Resource
{
    protected static ?string $model = Symptom::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Gejala';
    protected static ?string $modelLabel = 'Gejala';
    protected static ?string $pluralModelLabel = 'Gejala';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Gejala')
                    ->description('Informasi dasar tentang gejala penyakit')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Kode Gejala')
                                    ->maxLength(10)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('Otomatis: G01, G02, ...')
                                    ->helperText('Kode akan dibuat otomatis jika dikosongkan')
                                    ->disabled(fn ($record) => $record !== null)
                                    ->prefixIcon('heroicon-m-hashtag'),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Gejala')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-m-clipboard-document-list'),
                            ]),

                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Gejala')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'undo',
                                'redo',
                            ])
                            ->helperText('Deskripsi detail tentang gejala ini dan bagaimana cara mengidentifikasinya')
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
                    ->color('success'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Gejala')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),

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
            'index' => Pages\ListSymptoms::route('/'),
            'create' => Pages\CreateSymptom::route('/create'),
            'edit' => Pages\EditSymptom::route('/{record}/edit'),
        ];
    }
}
