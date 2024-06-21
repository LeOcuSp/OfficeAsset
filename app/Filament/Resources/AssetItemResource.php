<?php

namespace App\Filament\Resources;

use livewire;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use App\Models\AssetItem;
use App\Models\AssetDonor;
use Filament\Tables\Table;
use App\Models\AssetDamage;
use App\Models\AssetAllocation;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AssetItemResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AssetItemResource\RelationManagers;
use App\Filament\Resources\AssetItemResource\Pages\EditAssetItem;
use App\Filament\Resources\AssetItemResource\Pages\ListAssetItems;
use App\Filament\Resources\AssetItemResource\Pages\CreateAssetItem;

class AssetItemResource extends Resource
{

    protected static ?string $model = AssetItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    //     public function updateLatestAllocation(AssetItem $record)
    //     {
    //         // Assuming you have a relationship with the latest allocation model
    //         $record->latestAllocation()->update([
    //             'allocated_to' => 'New Allocation'
    //         ]);

    //         return redirect()->route('your-route-name', $record->getKey());
    //     }
    //     public static function getActions(): array
    // {
    //     return [
    //         // ... other actions ...
    //             AssetAllocation::make('Update Latest Allocation')
    //             ->action('updateLatestAllocation')
    //             ->icon('heroicon-s-pencil')
    //             ->color('success'),
    //         // ... other actions ...
    //     ];
    // }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('asset_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                Select::make('asset_donors_id')
                    ->label('Donor')
                    ->relationship('donor', 'name')
                    ->nullable(),

                Select::make('status')
                    ->label('Status')
                    ->default('Active')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                    ]),

                Placeholder::make('latest_allocation')
                    ->label('Latest Allocation')
                    ->content(function ($record) {
                        if ($record && $record->latestAllocation) {
                            return $record->latestAllocation->allocated_to;
                        } else {
                            return 'No allocations yet';
                        }
                    }),

                TextInput::make('brand')->required(),
                TextInput::make('model'),
                DatePicker::make('date_of_purchase')->required(),
                TextInput::make('description')->nullable(),
                TextInput::make('serial_number')->required()->unique(ignoreRecord: true),
                TextInput::make('asset_number')->required()->unique(ignoreRecord: true),
                DatePicker::make('date_of_warranty'),
                TextInput::make('location')->required(),
                TextInput::make('vendor')->required(),
                TextInput::make('purchased_price')
                    ->required()
                    ->prefix('THB')
                    ->afterStateHydrated(function ($state, Set $set) {
                        $set('purchased_price', 'THB', number_format((float)$state, 2, '.', ','));
                    })
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('purchased_price', 'THB', number_format((float)$state, 2, '.', ','));
                    }),
                TextInput::make('remark')->nullable(),

            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('brand'),
                TextColumn::make('model'),
                TextColumn::make('date_of_purchase')->date(),
                TextColumn::make('serial_number'),
                TextColumn::make('asset_number'),
                TextColumn::make('status')->badge()->color(fn ($state) => $state === 'Active' ? 'success' : 'danger'),
                TextColumn::make('date_of_warranty')->date(),
                TextColumn::make('donor.name')->label('Donor'),
                TextColumn::make('location'),
                TextColumn::make('vendor'),
                TextColumn::make('purchased_price')
            ])
            ->searchable()
            ->recordUrl(null)
            ->actions([
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListAssetItems::route('/'),
            'create' => Pages\CreateAssetItem::route('/create'),
            'edit' => Pages\EditAssetItem::route('/{record}/edit'),
        ];
    }
}
