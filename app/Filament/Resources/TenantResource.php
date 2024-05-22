<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources;

use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Core\Filament\Traits\HasTranslateResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Leandrocfe\FilamentPtbrFormFields\Cep;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class TenantResource extends Resource
{
    use HasTranslateResource;

    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label(static::translateForm("name"))
                                    ->placeholder(static::translateFormPlaceholder("name"))
                                    ->columnSpan([
                                        'md' => 7
                                    ])
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->label(static::translateForm("email"))
                                    ->placeholder(static::translateFormPlaceholder("email"))
                                    ->email()
                                    ->columnSpan([
                                        'md' => 5
                                    ]),
                                Document::make('document')
                                    ->cnpj()
                                    ->label(static::translateForm("document"))
                                    ->placeholder(static::translateFormPlaceholder("document"))
                                    ->columnSpan([
                                        'md' => 4
                                    ]),
                                PhoneNumber::make('phone')
                                    ->label(static::translateForm("phone"))
                                    ->placeholder(static::translateFormPlaceholder("phone"))
                                    ->tel()
                                    ->maxLength(255)
                                    ->columnSpan([
                                        'md' => 4
                                    ]),
                                Forms\Components\TextInput::make('domain')
                                    ->label(static::translateForm("domain"))
                                    ->placeholder(static::translateFormPlaceholder("domain"))
                                    ->maxLength(255)
                                    ->columnSpan([
                                        'md' => 4
                                    ]),
                            ])->columnSpan([
                                'md' => 2
                            ])->columns(12),
                        Forms\Components\Section::make()
                            ->schema([
                                CuratorPicker::make('logo')
                                    ->label(static::translateForm("logo"))
                                    ->columnSpanFull(),
                            ])->columnSpan([
                                'md' => 1
                            ]),

                    ])
                    ->columns(3),
                Forms\Components\Section::make('address')
                    ->heading(static::translateForm("address"))
                    ->relationship('address')
                    ->schema(function () {

                        return [
                            Forms\Components\TextInput::make('name')
                                ->label(static::translateForm("name", "/address"))
                                ->placeholder(static::translateFormPlaceholder("name", "/address"))
                                ->columnSpan([
                                    'md' => 3
                                ])
                                ->maxLength(255),
                            Cep::make('zip')
                                ->label(static::translateForm("zip", "/address"))
                                ->placeholder(static::translateFormPlaceholder("zip", "/address"))
                                ->viaCep(setFields: [
                                    'city' => 'localidade',
                                    'state' => 'uf',
                                    'country' => 'pais',
                                    'street' => 'logradouro',
                                    'district' => 'bairro',
                                    'number' => 'complemento',
                                    'complement' => 'complemento',
                                    'latitude' => 'latitude',
                                    'longitude' => 'longitude',
                                ])
                                ->columnSpan([
                                    'md' => 3
                                ]),
                            Forms\Components\TextInput::make('city')
                                ->label(static::translateForm("city", "/address"))
                                ->placeholder(static::translateFormPlaceholder("city", "/address"))
                                ->columnSpan([
                                    'md' => 4
                                ]),
                            Forms\Components\TextInput::make('state')
                                ->label(static::translateForm("state", "/address"))
                                ->placeholder(static::translateFormPlaceholder("state", "/address"))
                                ->columnSpan([
                                    'md' => 2
                                ]),
                            Forms\Components\TextInput::make('country')
                                ->label(static::translateForm("country", "/address"))
                                ->placeholder(static::translateFormPlaceholder("country", "/address"))
                                ->columnSpan([
                                    'md' => 2
                                ]),
                            Forms\Components\TextInput::make('street')
                                ->label(static::translateForm("street", "/address"))
                                ->placeholder(static::translateFormPlaceholder("street", "/address"))
                                ->columnSpan([
                                    'md' => 5
                                ]),
                            Forms\Components\TextInput::make('district')
                                ->label(static::translateForm("district", "/address"))
                                ->placeholder(static::translateFormPlaceholder("district", "/address"))
                                ->columnSpan([
                                    'md' => 3
                                ]),
                            Forms\Components\TextInput::make('number')
                                ->label(static::translateForm("number", "/address"))
                                ->placeholder(static::translateFormPlaceholder("number", "/address"))
                                ->columnSpan([
                                    'md' => 2
                                ]),
                            Forms\Components\TextInput::make('complement')
                                ->label(static::translateForm("complement", "/address"))
                                ->placeholder(static::translateFormPlaceholder("complement", "/address"))
                                ->columnSpan([
                                    'md' => 6
                                ]),
                            Forms\Components\TextInput::make('latitude')
                                ->label(static::translateForm("latitude", "/address"))
                                ->placeholder(static::translateFormPlaceholder("latitude", "/address"))
                                ->columnSpan([
                                    'md' => 3
                                ]),
                            Forms\Components\TextInput::make('longitude')
                                ->label(static::translateForm("longitude", "/address"))
                                ->placeholder(static::translateFormPlaceholder("longitude", "/address"))
                                ->columnSpan([
                                    'md' => 3
                                ]),
                            Forms\Components\Textarea::make('description')
                                ->label(static::translateForm("description"))
                                ->placeholder(static::translateFormPlaceholder("description"))
                                ->columnSpanFull(),
                            static::getStatusFormRadio('status')->columnSpanFull(),
                        ];
                    })
                    ->columns(12),
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
                Tables\Columns\TextColumn::make('name')
                    ->label(static::translateColumnLabel("name"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(static::translateColumnLabel("email"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('document')
                    ->label(static::translateColumnLabel("document"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(static::translateColumnLabel("phone"))
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->label(static::translateColumnLabel("domain"))
                    ->searchable(),
                static::getStatusTableIconColumn('status'),
                ...static::getFieldDatesFormForTable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make("activities")->url(fn (Tenant $record) => static::getUrl("activities", ["record" => $record])),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (Tenant $record) => auth()->user()->can(static::canDelete($record))),
                    Tables\Actions\ForceDeleteBulkAction::make()->visible(fn (Tenant $record) => auth()->user()->can(static::canForceDelete($record))),
                    Tables\Actions\RestoreBulkAction::make()->visible(
                        fn (Tenant $record) => auth()->user()->can(static::canRestore($record)),
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'activities' => Pages\ListActivitiesTenant::route('/{record}/activities'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
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
