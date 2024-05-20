<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Acl;

use App\Filament\Resources\Acl\RoleResource\Pages;
use App\Filament\Resources\Acl\RoleResource\RelationManagers;
use App\Models\Acl\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;

class RoleResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-lock-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(static::translateForm("name"))
                    ->placeholder(static::translateFormPlaceholder("name"))
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->label(static::translateForm("slug"))
                    ->placeholder(static::translateFormPlaceholder("slug"))
                    ->maxLength(255),
                //permissions
                Forms\Components\CheckboxList::make('permissions')
                    ->label(static::translateForm('permissions'))
                    ->relationship('permissions', 'name')
                    ->searchable()
                    ->columnSpanFull(),
                Forms\Components\Radio::make('special')
                    ->label(static::translateForm("special"))
                    ->options([
                        'all-access' => static::translateFormOption('special', 'all-access'),
                        'no-access' => static::translateFormOption('special', 'no-access'),
                    ])->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->label(static::translateForm("description"))
                    ->placeholder(static::translateFormPlaceholder("description"))
                    ->columnSpanFull(),
                static::getStatusFormRadio('status')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(static::translateColumnLabel("name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(static::translateColumnLabel("slug"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('special')
                    ->label(static::translateColumnLabel("special"))
                    ->searchable(),

                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")
                ->url(fn (Role $record) => static::getUrl("activities", ["record" => $record]))->visible(fn (Role $record) => auth()->user()->can(static::canAccess($record))),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (Role $record) => auth()->user()->can(static::canDelete($record))),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (Role $record) => auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(
                        fn (Role $record) => auth()->user()->can(static::canRestore($record)),
                    ),
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'activities' => Pages\ListActivitiesRole::route('/{record}/activities'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
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
