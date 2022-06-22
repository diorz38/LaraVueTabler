<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JafungResource\Pages;
use App\Filament\Resources\JafungResource\RelationManagers;
use App\Models\Jafung;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JafungResource extends Resource
{
    protected static ?string $model = Jafung::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('klasifikasi')
                    ->required(),
                Forms\Components\TextInput::make('no')
                    ->required(),
                Forms\Components\TextInput::make('unsur')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('sub_kode')
                    ->required(),
                Forms\Components\TextInput::make('department_name')
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('klasifikasi'),
            Tables\Columns\TextColumn::make('no'),
            Tables\Columns\TextColumn::make('unsur'),
            Tables\Columns\TextColumn::make('sub_kode'),
            Tables\Columns\TextColumn::make('department_name'),
            Tables\Columns\TextColumn::make('start_date')
                ->date(),
            Tables\Columns\TextColumn::make('end_date')
                ->date(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListJafungs::route('/'),
            'create' => Pages\CreateJafung::route('/create'),
            'edit' => Pages\EditJafung::route('/{record}/edit'),
        ];
    }
}
