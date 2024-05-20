<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Acl;

use App\Filament\Resources\Acl\GroupResource\Pages;
use App\Filament\Resources\Acl\GroupResource\RelationManagers;
use App\Models\Acl\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;

class GroupResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(static::translateForm("name"))
                    ->placeholder(static::translateFormPlaceholder("name"))
                    ->columnSpanFull()
                    ->maxLength(255),
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

                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (Group $record) => static::getUrl("activities", ["record" => $record])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (Group $record) => auth()->user()->can(static::canDelete($record))),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (Group $record) => auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(fn (Group $record) => auth()->user()->can(static::canRestore($record))),
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'activities' => Pages\ListActivitiesGroup::route('/{record}/activities'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
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
