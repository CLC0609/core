<?php

namespace App\Filament\Support\Actions;

use Filament\Actions\Action;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Js;

class CopyTextAction
{
    public static function make(mixed $state): Action
    {
        $copyText = self::normalize($state);

        return Action::make('copy')
            ->hiddenLabel()
            ->icon('heroicon-m-clipboard')
            ->color('gray')
            ->tooltip('Copy')
            ->iconButton()
            ->action(fn ($livewire) => $livewire->js('navigator.clipboard.writeText('.Js::from($copyText).')'));
    }

    public static function normalize(mixed $state): string
    {
        if ($state instanceof HtmlString) {
            $state = $state->toHtml();
        }

        $text = html_entity_decode(strip_tags((string) $state), ENT_QUOTES | ENT_HTML5);

        return trim(preg_replace('/[\t ]+/', ' ', $text) ?? $text);
    }
}
