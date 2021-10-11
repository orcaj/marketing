<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AddReport;
use App\Models\Creative;
use App\Models\Digital;
use App\Models\EmpClient;
use App\Models\Invoice;
use App\Models\Media;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
    //     if (Session::get('lang')) {
    //         App::setLocale(Session::get('lang'));
    //     }
    //     if (view()->exists($request->path())) {
    //         return view($request->path());
    //     }
    //     return view('pages-404');
    // }

    public function root(Request $request)
    {
        if (Session::get('lang')) {
            App::setLocale(Session::get('lang'));
        }

        $media = Media::where('id', '!=', '-4');
        $social_media = SocialMedia::where('id', '!=', '-4');
        $clients = User::where('role', 'client');
        $digital_marketing = Digital::where('id', '!=', '-4');
        $creative = Creative::where('id', '!=', '-4');
        $reports = AddReport::where('id', '!=', '-4');

        $invoice = Invoice::where('id', '!=', '-4');
        $invoice_pending = Invoice::where('status', 'pending');
        $invoice_paid = Invoice::where('status', 'Paid');
        $invoice_unpaid = Invoice::where('status', 'not paid');

        $user_role = auth()->user()->role;

        $emp = $request->emp;
        $client = $request->client;

        switch ($user_role) {
            case 'emp':
                $emp = Auth::id();
                break;

            case 'client':
                $client = Auth::id();
                break;

            default:
                # code...
                break;
        }

        $service_media = [];
        $service_social_media = [];
        $service_digital_media = [];
        $service_creative_media = [];

        for ($i = 1; $i < 13; $i++) {
            $i = $i < 10 ? '0' . $i : $i;
            $ie = $i + 1;

            $ie = $ie < 10 ? '0' . $ie : $ie;

            $start_date = date('Y-' . $i . '-01');
            $end_date = date('Y-' . $ie . '-01');

            $service_media_unit = Media::where('created_at', '>', $start_date)
                ->where('created_at', '<', $end_date);

            $service_social_media_unit = SocialMedia::where('created_at', '>', $start_date)
                ->where('created_at', '<', $end_date);

            $service_digital_media_unit = Digital::where('created_at', '>', $start_date)
                ->where('created_at', '<', $end_date);

            $service_creative_media_unit = Creative::where('created_at', '>', $start_date)
                ->where('created_at', '<', $end_date);

            switch ($user_role) {
                case 'emp':
                    $clients = EmpClient::where('emp_id', Auth::user()->id)->pluck('client_id');
                    $service_media_unit->whereIn('client_id', $clients);
                    $service_social_media_unit->whereIn('client_id', $clients);
                    $service_digital_media_unit->whereIn('client_id', $clients);
                    $service_creative_media_unit->whereIn('client_id', $clients);
                    break;

                case 'client':
                    $service_media_unit->where('client_id', $client);
                    $service_social_media_unit->where('client_id', $client);
                    $service_digital_media_unit->where('client_id', $client);
                    $service_creative_media_unit->where('client_id', $client);
                    break;

                default:
                    # code...
                    break;
            }

            if ($emp) {
                $clients = EmpClient::where('emp_id', $emp)->pluck('client_id');

                $service_media_unit->whereIn('client_id', $clients);
                $service_social_media_unit->whereIn('client_id', $clients);
                $service_digital_media_unit->whereIn('client_id', $clients);
                $service_creative_media_unit->whereIn('client_id', $clients);
            }

            if ($client) {
                $service_media_unit->where('client_id', $client);
                $service_social_media_unit->where('client_id', $client);
                $service_digital_media_unit->where('client_id', $client);
                $service_creative_media_unit->where('client_id', $client);
            }


            array_push($service_media, $service_media_unit->count());

            array_push($service_social_media, $service_social_media_unit->count());

            array_push($service_digital_media, $service_digital_media_unit->count());

            array_push($service_creative_media, $service_creative_media_unit->count());
        }
        $data['service_media'] = json_encode($service_media);
        $data['service_social_media'] = json_encode($service_social_media);
        $data['service_digital_media'] = json_encode($service_digital_media);
        $data['service_creative_media'] = json_encode($service_creative_media);


        if ($emp) {
            $clients = EmpClient::where('emp_id', $emp)->pluck('client_id');

            $clients->whereIn('id', $clients);

            $media->whereIn('client_id', $clients);
            $social_media->whereIn('client_id', $clients);
            $digital_marketing->whereIn('client_id', $clients);
            $creative->whereIn('client_id', $clients);
            $reports->whereIn('client_id', $clients);

            $invoice->whereIn('client_id', $clients);
            $invoice_pending->whereIn('client_id', $clients);
            $invoice_paid->whereIn('client_id', $clients);
            $invoice_unpaid->whereIn('client_id', $clients);
        }

        if ($client) {
            // $client = $request->client;
            $media->where('client_id', $client);
            $social_media->where('client_id', $client);
            $clients->where('id', $client);
            $digital_marketing->where('client_id', $client);
            $creative->where('client_id', $client);
            $reports->where('client_id', $client);

            $invoice->where('client_id', $client);
            $invoice_pending->where('client_id', $client);
            $invoice_paid->where('client_id', $client);
            $invoice_unpaid->where('client_id', $client);
        }

        if ($request->start_date) {
            $start = $request->start_date;

            $media->where('created_at', '>', $start);
            $social_media->where('created_at', '>', $start);
            $clients->where('created_at', '>', $start);
            $digital_marketing->where('created_at', '>', $start);
            $creative->where('created_at', '>', $start);
            $reports->where('created_at', '>', $start);

            $invoice->where('created_at', '>', $start);
            $invoice_pending->where('created_at', '>', $start);
            $invoice_paid->where('created_at', '>', $start);
            $invoice_unpaid->where('created_at', '>', $start);
        }

        if ($request->end_date) {
            $end = date('Y-m-d H:i:s', strtotime($request->end_date . ' +1 day'));
            $media->where('created_at', '<', $end);
            $social_media->where('created_at', '<', $end);
            $clients->where('created_at', '<', $end);
            $digital_marketing->where('created_at', '<', $end);
            $creative->where('created_at', '<', $end);
            $reports->where('created_at', '<', $end);

            $invoice->where('created_at', '<', $end);
            $invoice_pending->where('created_at', '<', $end);
            $invoice_paid->where('created_at', '<', $end);
            $invoice_unpaid->where('created_at', '<', $end);
        }


        $data['media'] = $media->count();
        $data['social_media'] = $social_media->count();
        $data['clients'] = $clients->count();
        $data['digital_marketing'] = $digital_marketing->count();
        $data['creative'] = $creative->count();
        $data['reports'] = $reports->count();

        $data['invoice'] = $invoice->count();
        $data['invoice_pending'] = $invoice_pending->count();
        $data['invoice_paid'] = $invoice_paid->count();
        $data['invoice_unpaid'] = $invoice_unpaid->count();


        $data['ads'] = Ad::where('user_type', $user_role)->get();


        return view('index', $data);
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
}
