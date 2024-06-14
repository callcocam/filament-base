<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\TenantResource\RelationManagers;

use App\Core\Filament\Traits\HasTranslateResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class UsersRelationManager extends RelationManager
{
    use HasTranslateResource;

    protected static string $relationship = 'users';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('password') 
                ->default(now()->timestamp),
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                // CuratorColumn::make('avatar_url')
                //     ->circular()
                //     ->size(40)
                //     ->label(static::translateColumnLabel("avatar_url", '/acl/user')),
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
