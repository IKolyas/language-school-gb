<?php

namespace App\Admin\Controllers;

use App\Models\Dictionary;
use App\Models\Word;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WordController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Word';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Word());

        $grid->column('id', __('Id'));
        $grid->column('word', __('Word'));
        $grid->column('translation', __('Translation'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        //  CREATE
        $grid->quickCreate(function (Grid\Tools\QuickCreate $create) {
            $create->text('word', __('Word'));
            $create->text('translation', __('Translation'));
        });

        //  SEARCH
        $grid->quickSearch('word', 'translation');

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
        $show = new Show(Word::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('word', __('Word'));
        $show->field('translation', __('Translation'));
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
        $form = new Form(new Word());

        $form->text('word', __('Word'));
        $form->text('translation', __('Translation'));
        $form->listbox('dictionaries', __('Dictionaries'))->options(Dictionary::all()->pluck('dictionary_name', 'id'));

        return $form;
    }
}
