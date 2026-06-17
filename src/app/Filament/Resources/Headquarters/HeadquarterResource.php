<?php

namespace App\Filament\Resources\Headquarters;

use App\Filament\Resources\Headquarters\Pages\CreateHeadquarter;
use App\Filament\Resources\Headquarters\Pages\EditHeadquarter;
use App\Filament\Resources\Headquarters\Pages\ListHeadquarters;
use App\Filament\Resources\Headquarters\Schemas\HeadquarterForm;
use App\Filament\Resources\Headquarters\Tables\HeadquartersTable;
use App\Models\Headquarter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HeadquarterResource extends Resource
{
    protected static ?string $model = Headquarter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Sedes';

    protected static ?string $pluralModelLabel = 'Sedes';

    protected static ?string $modelLabel = 'Sede';

    public static function form(Schema $schema): Schema
    {
        return HeadquarterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HeadquartersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHeadquarters::route('/'),
            'create' => CreateHeadquarter::route('/create'),
            'edit' => EditHeadquarter::route('/{record}/edit'),
        ];
    }
}
