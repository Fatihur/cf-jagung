<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseResource\Pages;
use App\Filament\Resources\DiseaseResource\RelationManagers;
use App\Models\Disease;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiseaseResource extends Resource
{
    protected static ?string $model = Disease::class;

    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';
    protected static ?string $navigationLabel = 'Penyakit';
    protected static ?string $modelLabel = 'Penyakit';
    protected static ?string $pluralModelLabel = 'Penyakit';
    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->description('Informasi dasar tentang penyakit')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->label('Kode Penyakit')
                                    ->maxLength(10)
                                    ->unique(ignoreRecord: true)
                                    ->placeholder('Otomatis: P01, P02, ...')
                                    ->helperText('Kode akan dibuat otomatis jika dikosongkan')
                                    ->disabled(fn ($record) => $record !== null)
                                    ->prefixIcon('heroicon-m-hashtag'),

                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Penyakit')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-m-bug-ant'),
                            ]),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('Gambar Penyakit')
                            ->image()
                            ->directory('diseases')
                            ->visibility('public')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->helperText('Upload gambar untuk membantu identifikasi penyakit'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Deskripsi Detail')
                    ->description('Informasi detail tentang penyakit')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Deskripsi Penyakit')
                            ->required()
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
                            ->helperText('Deskripsi umum tentang penyakit ini'),

                        Forms\Components\RichEditor::make('causes')
                            ->label('Penyebab Penyakit')
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
                            ->helperText('Jelaskan penyebab utama penyakit ini'),

                        Forms\Components\RichEditor::make('symptoms_description')
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
                            ->helperText('Deskripsi detail gejala-gejala yang muncul'),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Pengendalian')
                    ->description('Metode pengendalian dan pencegahan')
                    ->schema([
                        Forms\Components\RichEditor::make('control_methods')
                            ->label('Metode Pengendalian')
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
                            ->helperText('Langkah-langkah pengendalian dan pencegahan penyakit'),
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
                    ->color('primary'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Penyakit')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->size(60),

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
            'index' => Pages\ListDiseases::route('/'),
            'create' => Pages\CreateDisease::route('/create'),
            'edit' => Pages\EditDisease::route('/{record}/edit'),
        ];
    }
}
