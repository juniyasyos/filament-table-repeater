<?php

namespace Juniyasyos\TableRepeater;

use Closure;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Support\Enums\Alignment;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Header
{
    use EvaluatesClosures;
    use Macroable;

    final public function __construct(
        public string $name,
        public string | Htmlable | Closure | null $label = null,
        public string | Closure | Alignment | null $align = null,
        public string | Closure | null $width = null,
        public bool | Closure | null $isRequired = null,
        public bool | Closure | null $sortable = null,
        public bool | Closure | null $filterable = null,
        public string | Closure | null $icon = null,
        public string | Closure | null $tooltip = null,
        public string | Closure | null $helpText = null,
        public bool | Closure | null $exportable = null,
    ){}

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function label(string | Htmlable | Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function align(string | Closure | Alignment $align): static
    {
        $this->align = $align;

        return $this;
    }

    public function width(string | Closure $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function markAsRequired(bool | Closure | null $condition = true): static
    {
        $this->isRequired = $condition;

        return $this;
    }

    public function getLabel(): string | Htmlable
    {
        return $this->evaluate($this->label)
            ?? (string) Str::of($this->name)->title();
    }

    public function getAlignment(): string | Alignment
    {
        return $this->evaluate($this->align)
            ?? Alignment::Start;
    }

    public function getWidth(): string
    {
        return $this->evaluate($this->width)
            ?? 'auto';
    }

    public function isRequired(): bool
    {
        return $this->evaluate($this->isRequired)
            ?? false;
    }

    public function sortable(bool | Closure $condition = true): static
    {
        $this->sortable = $condition;

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->evaluate($this->sortable)
            ?? false;
    }

    public function filterable(bool | Closure $condition = true): static
    {
        $this->filterable = $condition;

        return $this;
    }

    public function isFilterable(): bool
    {
        return $this->evaluate($this->filterable)
            ?? false;
    }

    public function icon(string | Closure $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): string | null
    {
        return $this->evaluate($this->icon);
    }

    public function tooltip(string | Closure $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    public function getTooltip(): string | null
    {
        return $this->evaluate($this->tooltip);
    }

    public function helpText(string | Closure $text): static
    {
        $this->helpText = $text;

        return $this;
    }

    public function getHelpText(): string | null
    {
        return $this->evaluate($this->helpText);
    }

    public function exportable(bool | Closure $condition = true): static
    {
        $this->exportable = $condition;

        return $this;
    }

    public function isExportable(): bool
    {
        return $this->evaluate($this->exportable)
            ?? true;
    }
}
