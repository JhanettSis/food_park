<?php

namespace App\DataTables;

use App\Models\BlogComment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogCommentDataTable extends DataTable
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
                $divOpen = '<div class="btn-group dropleft">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropleft </button>
                    <div class="dropdown-menu dropleft" x-placement="left-start" style="position: absolute; transform: translate3d(-2px, 0px, 0px); top: 0px; left: 0px; will-change: transform;">';

                if ($query->status === true) {
                    $btn_edit = "<a href='" . route('admin.blogs.comments.update', $query->id) . "' class='dropdown-item border border-info'><i class='fas fa-eye'></i> Visible </a>";
                } else {
                    $btn_edit = "<a href='" . route('admin.blogs.comments.update', $query->id) . "' class='dropdown-item border border-warning'><i class='fas fa-eye-slash'></i> Visible</a>";
                }
                $btn_delete = "<a href='" . route('admin.blogs.comments.destroy', $query->id) . "' class='dropdown-item border border-danger delete-item'><i class='fas fa-trash'></i> Delete</a>";

                $divClose = "</div>
            </div>";
                return $divOpen . $btn_edit . $btn_delete . $divClose;
            })
            ->addColumn('blog', function ($query) {
                return $query->blog->title;
            })
            ->addColumn('user_name', function ($query) {
                return $query->user->name;
            })
            ->addColumn('date', function ($query) {
                return date('d-m-Y | H:i', strtotime($query->created_at));
            })
            ->addColumn('status', function ($query) {
                if ($query->status === true) {
                    return '<span class="badge badge-primary">Approved</span>';
                } else {
                    return '<span class="badge badge-warning">Pending</span>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BlogComment $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blogcomment-table')
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
            Column::make('blog'),
            Column::make('user_name'),
            Column::make('comment'),
            Column::make('date'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(70)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'BlogComment_' . date('YmdHis');
    }
}
