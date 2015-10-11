<?php
/**
 * Created by PhpStorm.
 * User: Abhishek Bhatia
 * Date: 07-Oct-15
 * Time: 2:13 PM
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contacts;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagesController extends Controller
{
    /**
     * To display homepage of the app
     * @return \Illuminate\View\View
     */

    public function welcome()
    {
        return view('pages.welcome');
    }

    /**
     * To display about us page of the app
     * @return \Illuminate\View\View
     */

    public function about()
    {
        return view('pages.about');
    }

    /**
     * To display terms and conditions page of the app
     * @return \Illuminate\View\View
     */

    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * To display terms and conditions page of the app
     * @return \Illuminate\View\View
     */

    public function privacy()
    {
        return view('pages.privacy');
    }
}