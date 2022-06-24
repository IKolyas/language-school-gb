<?php

namespace App\Admin\Controllers;

use App\Models\School;
use App\Models\Teacher;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class TeacherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Teacher';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher());

        $grid->column('id', __('Id'));
        $grid->column('school.name', __('School'))->sortable();
        $grid->column('user.name', __('User'))->sortable();
        $grid->column('academic_degree', __('Academic degree'));
        $grid->column('about', __('About'));
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->selector(function (Grid\Tools\Selector $selector) {
            $selector->select('school_id', __('admin.school'), School::all()->pluck('name', 'id'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Teacher::findOrFail($id));

        $show->field('id', __('Id'));

        $show->user(__('admin.user'), function ($user) {
            $user->setResource('/admin/app/users');
            $user->id();
            $user->name();
            $user->email();
            $user->lastname();
        });

        $show->school(__('admin.school'), function ($school) {
            $school->setResource('/admin/app/schools');
            $school->id();
            $school->name();
            $school->address();
            $school->description();

        });

        $show->field('academic_degree', __('Academic degree'));
        $show->field('about', __('About'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Teacher());

        $form->select('user_id', 'User')->options(User::all()->pluck('name', 'id'));
        $form->select('school_id', 'School')->options(School::all()->pluck('name', 'id'));
        $form->text('academic_degree', __('Academic degree'));
        $form->textarea('about', __('About'));

        return $form;
    }
}
