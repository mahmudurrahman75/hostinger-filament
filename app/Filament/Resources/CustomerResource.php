<?php

namespace App\Filament\Resources;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

//use Illuminate\Database\Eloquent\Factories\HasFactory;



class CustomerResource extends Resource
{
    
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Shop';
    protected static ?int $navigationSort = 2;



    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(50),

            Forms\Components\TextInput::make('email')
                ->label('Email Address')
                ->required()
                ->email()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('phone')
                ->maxLength(50),

            Forms\Components\DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->required(),

            Forms\Components\TextInput::make('city')
                ->required(),

            Forms\Components\TextInput::make('zip_code')
                ->required(),

            Forms\Components\TextInput::make('address')
                ->required()
                ->columnSpanFull(),
        ])
        ->columns(2);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('city')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                ->date()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
