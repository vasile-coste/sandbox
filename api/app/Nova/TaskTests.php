<?php

namespace App\Nova;

use App\Models\Task;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class TaskTests extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TaskTest::class;

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
    public static $search = [];

    /**
     * Mennu name and page title
     *
     * @return void
     */
    public static function label()
    {
        return 'Task Tests';
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
            ID::make(),

            Select::make('Task', 'task_id')
                ->sortable()
                ->options(
                    Task::orderBy('name')->get()->mapWithKeys(function ($item) {
                        return [$item->id => $item->name];
                    })
                )
                ->displayUsingLabels()
                ->rules('required'),

            Text::make('Params')
                ->rules('required', 'max:255'),

            Text::make('Result')
                ->rules('required', 'max:255'),
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
    public static function searchable()
    {
        return false;
    }

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
