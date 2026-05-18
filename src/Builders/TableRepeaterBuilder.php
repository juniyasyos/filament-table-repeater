<?php

namespace Juniyasyos\TableRepeater\Builders;

use Juniyasyos\TableRepeater\Components\TableRepeater;
use Juniyasyos\TableRepeater\Header;
use Filament\Forms\Components\Component;

class TableRepeaterBuilder
{
    protected TableRepeater $component;

    /**
     * @var array<Component>
     */
    protected array $schema = [];

    /**
     * @var array<Header>
     */
    protected array $headers = [];

    protected function __construct()
    {
        $this->component = TableRepeater::make('items');
    }

    /**
     * Create a new builder instance
     */
    public static function make(string $name = 'items'): self
    {
        $builder = new self();
        $builder->component = TableRepeater::make($name);

        return $builder;
    }

    /**
     * Set the schema
     *
     * @param  array<Component>  $schema
     */
    public function withSchema(array $schema): self
    {
        $this->schema = $schema;
        $this->component->schema($schema);

        return $this;
    }

    /**
     * Add a component to the schema
     */
    public function addSchemaComponent(Component $component): self
    {
        $this->schema[] = $component;
        $this->component->schema($this->schema);

        return $this;
    }

    /**
     * Set the headers
     *
     * @param  array<Header>  $headers
     */
    public function withHeaders(array $headers): self
    {
        $this->headers = $headers;
        $this->component->headers($headers);

        return $this;
    }

    /**
     * Add a header
     */
    public function addHeader(Header $header): self
    {
        $this->headers[] = $header;
        $this->component->headers($this->headers);

        return $this;
    }

    /**
     * Enable streamlined mode
     */
    public function streamlined(bool $condition = true): self
    {
        $this->component->streamlined($condition);

        return $this;
    }

    /**
     * Show labels
     */
    public function showLabels(bool $condition = true): self
    {
        $this->component->showLabels($condition);

        return $this;
    }

    /**
     * Set default items
     */
    public function defaultItems(int $count): self
    {
        $this->component->defaultItems($count);

        return $this;
    }

    /**
     * Enable/disable adding items
     */
    public function addable(bool $condition = true): self
    {
        $this->component->itemsAddable($condition);

        return $this;
    }

    /**
     * Enable/disable deleting items
     */
    public function deletable(bool $condition = true): self
    {
        $this->component->itemsDeletable($condition);

        return $this;
    }

    /**
     * Enable/disable reordering items
     */
    public function reorderable(bool $condition = true): self
    {
        $this->component->itemsReorderable($condition);

        return $this;
    }

    /**
     * Enable/disable cloning items
     */
    public function cloneable(bool $condition = true): self
    {
        $this->component->itemsCloneable($condition);

        return $this;
    }

    /**
     * Render header
     */
    public function renderHeader(bool $condition = true): self
    {
        $this->component->renderHeader($condition);

        return $this;
    }

    /**
     * Set empty label
     */
    public function emptyLabel(string | bool | null $label = null): self
    {
        $this->component->emptyLabel($label);

        return $this;
    }

    /**
     * Set stack at breakpoint
     */
    public function stackAt(string $breakpoint): self
    {
        $this->component->stackAt($breakpoint);

        return $this;
    }

    /**
     * Full featured setup
     */
    public function fullFeatured(): self
    {
        return $this
            ->renderHeader(true)
            ->showLabels(true)
            ->addable(true)
            ->deletable(true)
            ->reorderable(true)
            ->cloneable(true);
    }

    /**
     * Minimal setup
     */
    public function minimal(): self
    {
        return $this
            ->streamlined(true)
            ->showLabels(false)
            ->renderHeader(false);
    }

    /**
     * Read-only setup
     */
    public function readOnly(): self
    {
        return $this
            ->addable(false)
            ->deletable(false)
            ->reorderable(false)
            ->cloneable(false)
            ->renderHeader(true);
    }

    /**
     * Build the component
     */
    public function build(): TableRepeater
    {
        return $this->component;
    }

    /**
     * Get the built component
     */
    public function get(): TableRepeater
    {
        return $this->build();
    }
}
