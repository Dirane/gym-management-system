<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgressLogResource\Pages;
use App\Filament\Resources\ProgressLogResource\RelationManagers;
use App\Models\ProgressLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgressLogResource extends Resource
{
    protected static ?string $model = ProgressLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('goal_id')
                    ->numeric(),
                Forms\Components\TextInput::make('instructor_id')
                    ->numeric(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TextInput::make('weight')
                    ->numeric(),
                Forms\Components\TextInput::make('body_fat_percentage')
                    ->numeric(),
                Forms\Components\TextInput::make('muscle_mass')
                    ->numeric(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('photos')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('measurements')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('goal_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('instructor_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('body_fat_percentage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('muscle_mass')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProgressLogs::route('/'),
            'create' => Pages\CreateProgressLog::route('/create'),
            'edit' => Pages\EditProgressLog::route('/{record}/edit'),
        ];
    }
}
