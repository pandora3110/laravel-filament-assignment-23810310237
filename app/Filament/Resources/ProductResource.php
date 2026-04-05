<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Forms\Components\Section::make('Chi tiết sản phẩm')->schema([
            // Yêu cầu: Sử dụng Grid layout (2 cột)
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]),

            // Yêu cầu: Trình soạn thảo văn bản (Rich Editor)
            Forms\Components\RichEditor::make('description')->columnSpanFull(),

            // Yêu cầu: Upload 01 ảnh
            Forms\Components\FileUpload::make('image_path')
                ->image()
                ->directory('products'),

            // Yêu cầu: Grid 3 cột cho các con số & Trường sáng tạo
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->prefix('VNĐ')
                    ->required(),
                Forms\Components\TextInput::make('stock_quantity')
                    ->integer()
                    ->required(),
                // TRƯỜNG SÁNG TẠO: Thời gian bảo hành
                Forms\Components\TextInput::make('warranty_months')
                    ->label('Bảo hành (tháng)')
                    ->integer()
                    ->default(12),
            ]),
        ])
    ]);
}

public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('name')->searchable(),
        // Yêu cầu: Hiển thị giá định dạng VNĐ
        Tables\Columns\TextColumn::make('price')
            ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.') . ' VNĐ'),
        Tables\Columns\TextColumn::make('stock_quantity')->label('Kho'),
        Tables\Columns\TextColumn::make('warranty_months')->label('Bảo hành'),
    ])
    ->filters([
        Tables\Filters\SelectFilter::make('category')
            ->relationship('category', 'name'), // Bộ lọc theo danh mục
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
