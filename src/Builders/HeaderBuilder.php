<?php

namespace Awcodes\TableRepeater\Builders;

use Awcodes\TableRepeater\Header;
use Filament\Support\Enums\Alignment;
use Illuminate\Contracts\Support\Htmlable;

class HeaderBuilder
{
    protected Header $header;

    protected function __construct(string $name)
    {
        $this->header = Header::make($name);
    }

    /**
     * Create a new builder instance
     */
    public static function make(string $name): self
    {
        return new self($name);
    }

    /**
     * Set the label
     */
    public function label(string | Htmlable $label): self
    {
        $this->header->label($label);

        return $this;
    }

    /**
     * Set the alignment
     */
    public function align(Alignment | string $alignment): self
    {
        $this->header->align($alignment);

        return $this;
    }

    /**
     * Align to start
     */
    public function alignStart(): self
    {
        $this->header->align(Alignment::Start);

        return $this;
    }

    /**
     * Align to center
     */
    public function alignCenter(): self
    {
        $this->header->align(Alignment::Center);

        return $this;
    }

    /**
     * Align to end
     */
    public function alignEnd(): self
    {
        $this->header->align(Alignment::End);

        return $this;
    }

    /**
     * Set the width
     */
    public function width(string $width): self
    {
        $this->header->width($width);

        return $this;
    }

    /**
     * Set full width
     */
    public function fullWidth(): self
    {
        $this->header->width('100%');

        return $this;
    }

    /**
     * Set narrow width (80px)
     */
    public function narrow(): self
    {
        $this->header->width('80px');

        return $this;
    }

    /**
     * Mark as required
     */
    public function required(): self
    {
        $this->header->markAsRequired(true);

        return $this;
    }

    /**
     * Mark as optional
     */
    public function optional(): self
    {
        $this->header->markAsRequired(false);

        return $this;
    }

    /**
     * Build the header
     */
    public function build(): Header
    {
        return $this->header;
    }

    /**
     * Get the built header
     */
    public function get(): Header
    {
        return $this->build();
    }
}
