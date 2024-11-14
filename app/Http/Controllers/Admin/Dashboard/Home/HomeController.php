<?php

namespace App\Http\Controllers\Admin\Dashboard\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:home');
    }

    public function index()
    {
        $chart_options_posts = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'filter_field' => 'created_at',
            'filter_days' => 3600, // show only transactions for last 30 days
            //   'filter_period' => 'month', show only transactions for this week
            'chart_type' => 'line',
        ];
        $chart_posts = new LaravelChart($chart_options_posts);

        $chart_options_users = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'filter_field' => 'created_at',
            'filter_days' => 3600, // show only transactions for last 30 days
            //   'filter_period' => 'month', show only transactions for this week

            'chart_type' => 'bar',
        ];
        $chart_users = new LaravelChart($chart_options_users);


        $chart_options_contacts = [
            'chart_title' => 'Contacts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Contact',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            //   'filter_period' => 'month', show only transactions for this week

            'chart_type' => 'line',
        ];
        $chart_contacts = new LaravelChart($chart_options_contacts);

        $chart_options_comments = [
            'chart_title' => 'Comments by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Comment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'filter_field' => 'created_at',
            'filter_days' => 3600, // show only transactions for last 30 days
            //   'filter_period' => 'month', show only transactions for this week
            'chart_type' => 'bar',
        ];
        $chart_comments = new LaravelChart($chart_options_comments);
        return view('dashboard.index', compact('chart_comments','chart_contacts','chart_posts','chart_users'));

    }
}
