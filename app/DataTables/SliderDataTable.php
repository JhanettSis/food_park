<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * This method is responsible for creating the DataTable object.
     * It takes a QueryBuilder object ($query) as input,
     *  which represents the data source for the table.
     * (new EloquentDataTable($query)): Creates a new EloquentDataTable instance
     * using the provided $query.
     * ->addColumn('action', function($query){ ... }): Adds a new column named
     *  "action" to the DataTable.
     * The function($query) defines the content of this column, which in this case
     *  generates HTML for edit and delete buttons.
     * ->setRowId('id'): Sets the unique identifier for each row in the DataTable to the value of the 'id' column.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $divOpen = "<div class='buttons'>";
                $edit = "<a href='".route('admin.slider.edit', $query->id)."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "<a href='".route('admin.slider.destroy', $query->id)."' class='btn btn-danger delete-item'><i class='fas fa-trash'></i></a>";
                $divClose = "</div>";
                return $divOpen.$edit.$delete.$divClose;
            })->addColumn('image', function($query){
                return '<img class="img-fluid" alt="Image Slider"  src="'.asset($query->image).'">';
            })->addColumn('status', function($query){
                if($query->status == true){
                    return '<span class="badge badge-primary">Active</span>';
                }
                else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->rawColumns(['image', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * This method retrieves the data source for the DataTable.
     * It takes a Slider model instance as input.
     * $model->newQuery(): Creates a new Eloquent query builder
     * instance for the Slider model, which will be used to fetch the data
     * for the DataTable.
     *
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if I want to use the html builder, in this case I will use later.
     *
     * This method builds the HTML representation of the DataTable.
     * $this->builder(): Retrieves an instance of the HtmlBuilder class.
     * ->setTableId('slider-table'): Sets the ID attribute of the HTML table
     * element to "slider-table".
     * ->columns($this->getColumns()): Defines the columns that will be
     * displayed in the DataTable by calling the getColumns() method.
     * ->minifiedAjax(): Enables minified AJAX requests for better performance.
     * ->orderBy(1): Sets the initial sorting order of the table (e.g.,
     * by the first column).
     * ->selectStyleSingle(): Configures the table for single row selection.
     * ->buttons([...]): Adds buttons for exporting data to Excel, CSV, PDF, and other formats.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)// this is for the number of column, in this case is ID
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * This method defines the columns that will be displayed in the DataTable.
     * It returns an array of Column objects, each representing a column in the table.
     * Column::make('id'), Column::make('image'), etc.: Create columns for
     * the specified fields of the Slider model.
     * Column::computed('action'): Creates a computed column named "action".
     * ->exportable(false): Prevents the "action" column from being included
     * in exported data.
     * ->printable(false): Prevents the "action" column from being included
     * in printed output.
     * ->width(160): Sets the width of the "action" column to 160 pixels.
     * ->addClass('text-center'): Adds the "text-center" CSS class to the
     * "action" column for center alignment.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('offer'),
            Column::make('title'),
            Column::make('subtitle'),
            Column::computed('status')->addClass('text-uppercase'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160) // Define the width of the 'action' column in pixels
                ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     *
     * This method defines the filename for exported data files (e.g., Excel, CSV).
     * It generates a dynamic filename using the "Slider_" prefix and the current date and time.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
