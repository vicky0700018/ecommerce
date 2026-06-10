<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                \Filament\Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                TextInput::make('original_price')
                    ->label('Original Price (MRP)')
                    ->numeric()
                    ->prefix('₹'),
                TextInput::make('price')
                    ->label('Selling Price (Discounted)')
                    ->required()
                    ->numeric()
                    ->prefix('₹'),
                TextInput::make('image_url')
                    ->label('Image URL (Primary)')
                    ->columnSpanFull(),
                \Filament\Forms\Components\Repeater::make('images')
                    ->relationship('images')
                    ->label('Gallery Image URLs')
                    ->simple(
                        TextInput::make('image_path')
                            ->url()
                            ->placeholder('https://example.com/new-gallery.jpg')
                            ->required(),
                    )
                    ->addActionLabel('Add Another URL')
                    ->helperText('Paste external image links (like Unsplash) to add them to your gallery. To remove an image, just click Remove or clear the input.')
                    ->columnSpanFull(),
                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),
                \Filament\Forms\Components\Select::make('category')
                    ->options([
                        'Fashion' => 'Fashion',
                        'Mobile' => 'Mobile',
                        'Beauty' => 'Beauty',
                        'Electronics' => 'Electronics',
                        'Home' => 'Home',
                        'Appliances' => 'Appliances',
                        'Toys' => 'Toys',
                        'Baby' => 'Baby',
                        'Books' => 'Books',
                        'Furniture' => 'Furniture',
                        'Sports' => 'Sports',
                    ]),
            ]);
    }
}
