<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;

class PageResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(static::translateSection("content"))
                    ->schema([])
                    ->columns(12)
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 8
                    ]),
                Forms\Components\Section::make(static::translateSection("information"))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(static::translateForm("name"))
                            ->placeholder(static::translateFormPlaceholder("name"))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('route')
                            ->label(static::translateForm("route"))
                            ->placeholder(static::translateFormPlaceholder("route"))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('icon')
                            ->label(static::translateForm("icon"))
                            ->placeholder(static::translateFormPlaceholder("icon"))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('layout')
                            ->label(static::translateForm("layout"))
                            ->placeholder(static::translateFormPlaceholder("layout"))
                            ->maxLength(255),
                        Forms\Components\TextInput::make('template')
                            ->label(static::translateForm("template"))
                            ->placeholder(static::translateFormPlaceholder("template"))
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->label(static::translateForm("description"))
                            ->placeholder(static::translateFormPlaceholder("description"))
                            ->columnSpanFull(),
                        static::getStatusFormRadio('status')->columnSpanFull(),
                    ])
                    ->columnSpan([
                        'sm' => 12,
                        'md' => 4
                    ])
                    ->columns(1),

            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(static::translateColumnLabel("name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('route')
                    ->label(static::translateColumnLabel("route"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label(static::translateColumnLabel("icon"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('layout')
                    ->label(static::translateColumnLabel("layout"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('template')
                    ->label(static::translateColumnLabel("template"))
                    ->searchable(),
                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (Page $record) => static::getUrl("activities", ["record" => $record])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (Page $record) =>  auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(fn (Page $record) =>  auth()->user()->can(static::canRestore($record))),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'activities' => Pages\ListActivitiesPage::route('/{record}/activities'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
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
