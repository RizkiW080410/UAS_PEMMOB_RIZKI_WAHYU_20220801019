<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RankingResource\Pages;
use App\Models\Ranking;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RankingResource extends Resource
{
    protected static ?string $model = Ranking::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Hasil dan Ranking';

    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->relationship('client', 'name', function (Builder $query) {
                        $query->whereHas('hasilpertandingans');
                    })
                    ->required()
                    ->label('Client'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')->label('Client'),
                TextColumn::make('total_pertandingan')
                    ->label('Total Pertandingan')
                    ->getStateUsing(function ($record) {
                        return $record->total_pertandingan;
                    }),
                TextColumn::make('win')
                    ->label('Menang')
                    ->getStateUsing(function ($record) {
                        return $record->win;
                    }),
                TextColumn::make('lose')
                    ->label('Kalah')
                    ->getStateUsing(function ($record) {
                        return $record->lose;
                    }),
                TextColumn::make('rank')
                    ->label('Ranking')
                    ->sortable(),
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
            'index' => Pages\ListRankings::route('/'),
            'create' => Pages\CreateRanking::route('/create'),
            'edit' => Pages\EditRanking::route('/{record}/edit'),
        ];
    }
}
