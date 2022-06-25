<?php

namespace App\Admin\Controllers;

use App\Models\Dictionary;
use App\Models\User;
use App\Models\Word;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DictionaryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Dictionary';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Dictionary());

        $grid->column('id', __('Id'));
        $grid->column('dictionary_name', __('Dictionary name'));
        $grid->column('creator.name', __('Creator'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('dictionary_name', __('Dictionary name'));
            $create->select('creator_id', __('Creator'))->options(User::all()->pluck('name', 'id'));
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
        $show = new Show(Dictionary::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('dictionary_name', __('Dictionary name'));
        $show->field('creator.name', __('Creator'));
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
        $form = new Form(new Dictionary());

        $form->text('dictionary_name', __('Dictionary name'));
        $form->select('creator_id', __('Creator'))->options(User::all()->pluck('name','id')->toArray());
        $form->listbox('words', __('Words'))->options(Word::all()->pluck('word', 'id'))->height('200');
        $form->listbox('users', __('Users'))->options(User::all()->pluck('name', 'id'));

        return $form;
    }
}
