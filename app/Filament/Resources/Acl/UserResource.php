<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Acl;

use App\Filament\Resources\Acl\UserResource\Pages;
use App\Filament\Resources\Acl\UserResource\RelationManagers;
use App\Models\Acl\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class UserResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(static::translateForm("name"))
                    ->placeholder(static::translateFormPlaceholder("name"))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(static::translateForm("email"))
                    ->placeholder(static::translateFormPlaceholder("email"))
                    ->email()
                    ->required()
                    ->maxLength(255),
                PhoneNumber::make('phone')
                    ->label(static::translateForm("phone"))
                    ->placeholder(static::translateFormPlaceholder("phone")),
                Document::make('document')
                    ->label(static::translateForm("document"))
                    ->placeholder(static::translateFormPlaceholder("document"))
                    ->cpf(),
                //roles
                Forms\Components\CheckboxList::make('roles')
                    ->label(static::translateForm('roles'))
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('email')
                    ->label(static::translateColumnLabel("email"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(static::translateColumnLabel("phone"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('document')
                    ->label(static::translateColumnLabel("document"))
                    ->searchable(),
                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (User $record) => static::getUrl("activities", ["record" => $record])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (User $record) => auth()->user()->can(static::canDelete($record))),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (User $record) => auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(fn (User $record) => auth()->user()->can(static::canRestore($record)),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'activities' => Pages\ListActivitiesUser::route('/{record}/activities'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])->tenant();
    }
}
