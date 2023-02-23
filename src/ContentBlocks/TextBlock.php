<?php

namespace Statikbe\FilamentFlexibleContentBlocks\ContentBlocks;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Spatie\MediaLibrary\HasMedia;
use Statikbe\FilamentFlexibleContentBlocks\ContentBlocks\Concerns\HasBackgroundColour;
use Statikbe\FilamentFlexibleContentBlocks\Filament\Form\Fields\Blocks\BackgroundColourField;
use Statikbe\FilamentFlexibleContentBlocks\Models\Contracts\HasContentBlocks;

class TextBlock extends AbstractFilamentFlexibleContentBlock
{
    use HasBackgroundColour;

    public ?string $content;

    public ?string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(HasContentBlocks&HasMedia $record, ?array $blockData)
    {
        parent::__construct($record, $blockData);

        $this->content = $blockData['content'] ?? null;
        $this->backgroundColourType = $blockData['background_colour'] ?? null;
        $this->title = $blockData['title'] ?? null;
    }

    public static function getNameSuffix(): string
    {
        return 'text';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-view-list';
    }

    /**
     * {@inheritDoc}
     */
    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            TextInput::make('title')
                ->label(self::getFieldLabel('title')),
            RichEditor::make('content')
                ->label(self::getFieldLabel('label'))
                ->disableToolbarButtons([
                    'attachFiles',
                ])
                ->required(),
            Grid::make(2)->schema([
                BackgroundColourField::create(self::class),
            ]),
        ];
    }
}
