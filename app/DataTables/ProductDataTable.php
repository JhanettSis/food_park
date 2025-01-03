<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $divOpen = "<div class='buttons'>";
            $edit = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
            $delete = "<a href='" . route('admin.products.destroy', $query->id) . "' class='btn btn-danger delete-item'><i class='fas fa-trash'></i></a>";
            $divClose = "</div>";
            return $divOpen . $edit . $delete . $divClose;
        })->addColumn('product_image', function($query){
            return '<img class="img-fluid" alt="Image Slider"  src="'.asset($query->product_image).'">';
        })->addColumn('show_at_home', function ($query) {
            if ($query->show_at_home == true) {
                return '<span class="badge badge-success">Yes</span>';
            } else {
                return '<span class="badge badge-warning">No</span>';
            }
        })
        ->addColumn('status', function ($query) {
            if ($query->status == true) {
                return '<span class="badge badge-primary">Active</span>';
            } else {
                return '<span class="badge badge-danger">Inactive</span>';
            }
        })
        ->rawColumns(['product_image', 'show_at_home', 'status', 'action'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('product_image'),
            Column::make('product_name'),
            Column::make('price'),
            Column::make('offer_price'),
            Column::make('slug'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(140)
                ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
