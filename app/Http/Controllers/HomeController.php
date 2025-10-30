<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Menu;
use App\Models\Service;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Appointment_service;
use App\Models\Faq;
use App\Models\Message;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        // Lấy 5 bài viết mới nhất
        $post_events = Post::where('is_active', 1)->where('topic', 'Tin tức & sự kiện')->take(5)->orderBy('created_at', 'desc')->get();

        // Chia ra:
        $featuredPostEvent = $post_events->first(); // Bài viết đầu tiên (hiển thị to)
        $otherPostEvents = $post_events->slice(1); // 4 bài còn lại (nhỏ hơn)
        $post_knowlegdes = Post::where('is_active', 1)->where('topic', 'Kiến thức răng miệng')->take(6)->orderBy('created_at', 'desc')->get();
        $services = Service::where('status', 'Có sẵn')->where('post_id', '!=', null)->take(6)->orderBy('service_id', 'asc')->get();
        $doctors = Doctor::all();
        $faqs = Faq::where('is_active', 1)->orderBy('faq_id', 'asc')->get();
        return view('index', compact('post_events', 'featuredPostEvent', 'otherPostEvents', 'post_knowlegdes', 'services', 'doctors', 'faqs'));
    }

    public function post(Request $request)
    {
        $query = Post::query();

        if ($request->has('search_post') && $request->search_post != '') {
            $query->where('title', 'like', '%' . $request->search_post . '%')
                ->orWhere('contents', 'like', '%' . $request->search_post . '%');
        }

        $posts = $query->paginate(12)->withQueryString();
        return view('post', compact('posts'));
    }

    public function post_detail(Post $post)
    {
        if (!$post) {
            return redirect()->route('home/post')->with('error', 'Không tìm thấy bài viết');
        }

        // Lấy các bài viết khác (ngoại trừ bài viết đang xem)
        $relatedPosts = Post::where('post_id', '!=', $post->post_id)->where('topic', $post->topic)->latest()->take(10)->get();

        return view('post_detail', compact('post', 'relatedPosts'));
    }

    public function post_event()
    {
        $posts = Post::where('is_active', 1)->where('topic', 'Tin tức & sự kiện')->orderBy('created_at', 'desc')->paginate(8);
        return view('post_event', compact('posts'));
    }

    public function post_knowledge()
    {
        $posts = Post::where('is_active', 1)->where('topic', 'Kiến thức răng miệng')->orderBy('created_at', 'desc')->paginate(8);
        return view('post_knowledge', compact('posts'));
    }

    public function post_service()
    {
        $posts = Post::where('is_active', 1)->where('topic', 'Dịch vụ')->orderBy('created_at', 'desc')->paginate(8);
        return view('post_service', compact('posts'));
    }

    public function service()
    {
        $services = Service::where('status', 'Có sẵn')->where('post_id', '!=', null)->orderBy('service_id', 'asc')->get();
        return view('service', ['services' => $services]);
    }

    public function about()
    {
        return view('about');
    }

    public function appointment()
    {
        $services = Service::where('status', 'Có sẵn')->get();

        return view('appointment', ['services' => $services]);
    }

    public function getSlots(Request $request)
    {
        $date = $request->input('date');

        $timeSlots = [
            '08:00:00',
            '09:30:00',
            '14:00:00',
            '15:30:00'
        ];

        $maxPerSlot = 5;

        $appointments = Appointment::select('appointment_time', Appointment::raw('count(*) as total'))
            ->where('appointment_date', $date)
            ->groupBy('appointment_time')
            ->pluck('total', 'appointment_time')
            ->toArray();

        $result = collect($timeSlots)->map(function ($time) use ($appointments, $maxPerSlot) {
            $booked = $appointments[$time] ?? 0;
            $available = $maxPerSlot - $booked;
            return [
                'time' => $time,
                'booked' => $booked,
                'available' => $available,
            ];
        });

        return response()->json($result);
    }

    public function appointment_create(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,user_id',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'services' => 'required|array',
        ], [
            'patient_id.required' => 'Vui lòng đăng nhập để đặt lịch khám',
            'patient_id.exists' => 'Bệnh nhân không tồn tại',
            'appointment_date.required' => 'Vui lòng chọn ngày khám',
            'appointment_time.required' => 'Vui lòng chọn giờ khám',
            'services.required' => 'Vui lòng chọn dịch vụ',
        ]);

        $data = new Appointment();
        $data->patient_id = $request['patient_id'];
        $data->appointment_date = $request['appointment_date'];
        $data->appointment_time = $request['appointment_time'];
        $data->notes = $request['notes'];
        $data->save();

        foreach ($request->services as $service_id) {
            $appointmentService = new Appointment_service();
            $appointmentService->appointment_id = $data->appointment_id;
            $appointmentService->service_id = $service_id;
            $appointmentService->save();
        }
        return redirect()->route('patient/appointment', $request->patient_id)->with('success', 'Đặt lịch hẹn thành công');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Message::create($data);

        return redirect()->route('home/contact')->with('success', 'Gửi tin nhắn thành công');
    }

}
