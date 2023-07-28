<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Birthday;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('m-d');
        $data = Birthday::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday_date) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(birthday_date)')
            ->orderByRaw('DAYOFYEAR(birthday_date)')
            ->get();


        // $data =  Birthday::whereMonth('birthday_date', '>', $date->month)

        //     ->orWhere(function ($query) use ($date) {

        //         $query->whereMonth('birthday_date', '=', $date->month)

        //             ->whereDay('birthday_date', '>=', $date->day);
        //     })
        //     ->take(3)
        //     ->get();
        // $data = Birthday::get();
        return view('front.home', compact('data'));

        // Get the current year
        // $currentYear = Carbon::now()->month;

        // // Retrieve the birthdays data from the database
        // $birthdays = Birthday::whereYear('birthday_date', '>=', $currentYear)
        //     // ->whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(birthday_date) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(birthday_date)')
        //     // ->orderByRaw('DAYOFYEAR(birthday_date)')
        //     ->get();

        // $data = [];
        // foreach ($birthdays as $birthday) {
        //     $data[] = [
        //         'id' => $birthday->id,
        //         'name' => $birthday->name,
        //         'start' => $birthday->birthday_date,
        //         'description' => $birthday->description,
        //     ];
        // }
        // return view('front.home', compact('data'));
    }
}
