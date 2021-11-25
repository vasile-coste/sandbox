<?php

namespace App\Nova;

use App\Models\Task;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;

class Tasks extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Task::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'badge', 'content',
    ];

    /**
     * Mennu name and page title
     *
     * @return void
     */
    public static function label()
    {
        return 'Tasks';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:100'),

            Select::make('Badge')->options([
                Task::EASY => Task::EASY,
                Task::MEDIUM => Task::MEDIUM,
                Task::HARD => Task::HARD,
            ])
                ->sortable()
                ->displayUsingLabels()
                ->rules('required'),

            Trix::make('Content')
                ->withMeta(['extraAttributes' => [
                    'placeholder' => 'Task content...'],
                ])
                ->rules('required'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Disable search
     *
     * @param Request $request
     * @return void
     */
    // public static function searchable()
    // {
    //     return false;
    // }

    /**
     * Disable create
     *
     * @param Request $request
     * @return void
     */
    // public static function authorizedToCreate(Request $request)
    // {
    //     return false;
    // }

    /**
     * Disable delete
     *
     * @param Request $request
     * @return void
     */
    // public function authorizedToDelete(Request $request)
    // {
    //     return false;
    // }

    /**
     * Disable update
     *
     * @param Request $request
     * @return void
     */
    // public function authorizedToUpdate(Request $request)
    // {
    //     return false;
    // }
}
