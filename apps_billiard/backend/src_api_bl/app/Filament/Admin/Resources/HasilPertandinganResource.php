<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HasilPertandinganResource\Pages;
use App\Models\HasilPertandingan;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class HasilPertandinganResource extends Resource
{
    protected static ?string $model = HasilPertandingan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Hasil dan Ranking';

    protected static ?int $navigationSort = -3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('client_id')
                    ->relationship('client', 'name', function (Builder $query) {
                        $query->whereHas('pelatihans', function (Builder $query) {
                            $query->where('status', 'Lulus')->havingRaw('COUNT(*) >= 1');
                        });
                    })
                    ->required()
                    ->label('Pemain'),
                Select::make('pertandingan_id')
                    ->relationship('pertandingan', 'pertandingan_number', function (Builder $query) {
                        $query->where('status', 'Selesai');
                    })
                    ->required()
                    ->label('Nomor Pertandingan'),
                Select::make('pertandingan_id')
                    ->relationship('pertandingan', 'category', function (Builder $query) {
                        $query->where('status', 'Selesai');
                    })
                    ->required()
                    ->label('Category Pertandingan'),
                Select::make('pertandingan_id')
                    ->relationship('pertandingan', 'skor_a')
                    ->label('Skor Pemain a'),
                Select::make('pertandingan_id')
                    ->relationship('pertandingan', 'skor_b')
                    ->label('Skor Pemain b'),
                Select::make('status')
                    ->options([
                        'Menang' => 'Menang',
                        'Kalah' => 'Kalah',
                    ])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('client.name')->label('Pemain'),
                TextColumn::make('pertandingan.pertandingan_number')->label('Nomor Pertandingan'),
                TextColumn::make('pertandingan.category')->label('Category Pertandingan'),
                TextColumn::make('pertandingan')
                    ->label('Pemain A vs B')
                    ->formatStateUsing(function ($record) {
                        logger($record->toArray()); // Log data untuk debugging
                        if ($record->pertandingan) {
                            $clientA = $record->pertandingan->clientA->name ?? 'N/A';
                            $clientB = $record->pertandingan->clientB->name ?? 'N/A';

                            return "{$clientA} vs {$clientB}";
                        }

                        return 'Tidak Ada Pertandingan';
                    }),
                TextColumn::make('pertandingan.start_time')
                    ->label('Tanggal & Jam Mulai')
                    ->dateTime('d/m/Y H:i'),
                TextColumn::make('pertandingan.skor_a')->label('Skor A'),
                TextColumn::make('pertandingan.skor_b')->label('Skor B'),
                TextColumn::make('status')->label('Status'),
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
            'index' => Pages\ListHasilPertandingans::route('/'),
            'create' => Pages\CreateHasilPertandingan::route('/create'),
            'edit' => Pages\EditHasilPertandingan::route('/{record}/edit'),
        ];
    }
}
