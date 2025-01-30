<?php

namespace App\Filament\Admin\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Pertandingan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Admin\Resources\PertandinganResource\Pages;

class PertandinganResource extends Resource
{
    protected static ?string $model = Pertandingan::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static ?string $navigationGroup = 'Pelatihan dan Pertandingan';

    protected static ?int $navigationSort = -4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('pertandingan_number')
                    ->label('Nomor Pertandingan')
                    ->disabled()
                    ->default(fn () => Pertandingan::max('id') ? 'P-'.str_pad(Pertandingan::max('id') + 1, 5, '0', STR_PAD_LEFT) : 'P-00001')
                    ->required(),
                Select::make('client_a_id')
                    ->relationship('clientA', 'name', function (Builder $query) {
                        $query->whereHas('pelatihans', function (Builder $query) {
                            $query->where('status', 'Lulus')->havingRaw('COUNT(*) >= 1');
                        });
                    })
                    ->required()
                    ->label('Client A'),
                Select::make('client_b_id')
                    ->relationship('clientB', 'name', function (Builder $query) {
                        $query->whereHas('pelatihans', function (Builder $query) {
                            $query->where('status', 'Lulus')->havingRaw('COUNT(*) >= 1');
                        });
                    })
                    ->required()
                    ->label('Client B'),
                TextInput::make('category')->required(),
                DateTimePicker::make('start_time')
                    ->required()
                    ->label('Tanggal & Jam Mulai'),
                TextInput::make('skor_a')
                    ->label('Skor A'),
                TextInput::make('skor_b')
                    ->label('Skor B'),
                Select::make('status')
                    ->options([
                        'Belum Dimulai' => 'Belum Dimulai',
                        'Berlangsung' => 'Berlangsung',
                        'Selesai' => 'Selesai',
                    ])
                    ->required()
                    ->label('Status'),
                Card::make()
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('pertandingans/images')
                            ->nullable()
                            ->label('Image'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('clientA.name')->label('Pemain A'),
                TextColumn::make('clientB.name')->label('Pemain B'),
                TextColumn::make('category'),
                TextColumn::make('start_time')
                    ->label('Tanggal & Jam Mulai')
                    ->dateTime('d/m/Y H:i'),
                TextColumn::make('skor_a')->label('Skor A'),
                TextColumn::make('skor_b')->label('Skor B'),
                TextColumn::make('status')->label('Status'),
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->width(100)
                    ->height(100),
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
            'index' => Pages\ListPertandingans::route('/'),
            'create' => Pages\CreatePertandingan::route('/create'),
            'edit' => Pages\EditPertandingan::route('/{record}/edit'),
        ];
    }
}
