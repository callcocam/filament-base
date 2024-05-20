<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Acl;

use App\Filament\Resources\Acl\PermissionResource\Pages;
use App\Filament\Resources\Acl\PermissionResource\RelationManagers;
use App\Models\Acl\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;

class PermissionResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = Permission::class;


    protected static ?string $navigationIcon = 'heroicon-o-key';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'name')
                    ->label(static::translateForm("group_id"))
                    ->placeholder(static::translateFormPlaceholder("group_id"))
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 3,
                    ]),
                Forms\Components\TextInput::make('name')
                    ->label(static::translateForm('name'))
                    ->placeholder(static::translateFormPlaceholder('name'))
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4,
                    ])
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->label(static::translateForm('slug'))
                    ->placeholder(static::translateFormPlaceholder('slug'))
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 5,
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label(static::translateForm("description"))
                    ->placeholder(static::translateFormPlaceholder("description"))
                    ->columnSpanFull(),
                static::getStatusFormRadio('status')->columnSpanFull(),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group.name')
                    ->label(static::translateColumnLabel("group_id"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(static::translateColumnLabel("name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(static::translateColumnLabel("slug"))
                    ->searchable(),

                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (Permission $record) => static::getUrl("activities", ["record" => $record]))->visible(fn (Permission $record) => auth()->user()->can(static::canAccess($record))),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (Permission $record) => auth()->user()->can(static::canDelete($record))),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (Permission $record) => auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(fn (Permission $record) => auth()->user()->can(static::canRestore($record))),
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'activities' => Pages\ListActivitiesPermission::route('/{record}/activities'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
