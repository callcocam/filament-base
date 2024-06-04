<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources;

use App\Filament\Resources\AboutResource\Pages;
use App\Filament\Resources\AboutResource\RelationManagers;
use App\Models\About;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;

class AboutResource extends Resource
{
    use HasTranslateResource;

    protected static ?int $navigationSort = 5;

    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label(static::translateForm("name"))
                ->placeholder(static::translateFormPlaceholder("name"))
                ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                ->label(static::translateForm("image"))
                ->placeholder(static::translateFormPlaceholder("image"))
                ->columnSpanFull()
                    ->image(),
                Forms\Components\RichEditor::make('description')
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
                Tables\Columns\ImageColumn::make('image')
                ->label(static::translateColumnLabel("image")),
                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (About $record) => static::getUrl("activities", ["record" => $record])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (About $record) =>  auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(fn (About $record) =>  auth()->user()->can(static::canRestore($record))),
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
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'activities' => Pages\ListActivitiesAbout::route('/{record}/activities'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
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
